<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="card" v-if="!preload">
    <div class="card-header">
      <h3 class="card-title">Lista de Usuarios</h3>
      <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
          <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar.." v-model="pagination.search" v-on:keyup="changeSearch()">

          <!--<div class="input-group-append">
            <button type="text" class="btn btn-default" >
              <i class="fa fa-search"></i>
            </button>
          </div>-->
        </div>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover">
        <tbody><tr>
          <th>#</th>
          <th>Email</th>
          <th>Nombre</th>
          <th>Telefono</th>
          <th>Ciudad</th>
          <th>Direccion</th>
          <th>Facebook</th>
          <th>Linkedin</th>
          <th>Fecha creacion</th>
          <th>Ultimo Ingreso</th>
        </tr>
        <tr v-for="usuario in pagination.datafilter">
          <td v-text='usuario.id'></td>
          <td v-text='usuario.email'></td>
          <td v-text='usuario.nombre'></td>
          <td v-text='usuario.telefono'></td>
          <td v-text='usuario.ciudad'></td>
          <td v-text='usuario.direccion'></td>
          <td v-text='usuario.facebook'></td>
          <td v-text='usuario.linkedin'></td>
          <td v-text='usuario.created_at'></td>
          <td v-text='usuario.fecha_ultimo_ingreso'></td>
        </tr>
      </tbody></table>
    </div>
    <div class="card-footer">
      <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item" v-bind:class="[pagination.page > 1 ? '' : 'disabled']">
          <a class="page-link" href="#" v-on:click.prevent="changePage(pagination.page-1)">«</a>
        </li>
        <li class="page-item" v-for="page in pagesNumbers" v-bind:class="[ page == isActived ? 'active' : '']">
          <a class="page-link" href="#" v-on:click.prevent="changePage(page)">
            <span v-text='page'></span>
          </a>
        </li>
        <li class="page-item" v-bind:class="[pagination.page < pagination.total_pages ? '' : 'disabled']">
          <a class="page-link" href="#"  v-on:click.prevent="changePage(pagination.page+1)">»</a>
        </li>
      </ul>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        mounted() {

        },created : function(){
          this.base_url=base_url;
          this.listado();
        },
        data: function () {
          return {
            preload:false,
            pagination :{
                  page : 0,
                  per_page : 8,
                  next_page : 0,
                  total : 0,
                  total_pages : 0,
                  offset : 2,
                  data : [],
                  datafilter : [],
                  search : '',
                  keys : ["email","nombre","telefono","ciudad","direccion","facebook","linkedin"]
            }
          }
        },
        computed : {
          isActived : function(){
              return this.pagination.page;
          },
          pagesNumbers : function(){
              if(this.pagination.total_pages <= 1){
                  return [];
              }

              var from    =this.pagination.page - this.pagination.offset;
              if(from < 1){
                  from = 1;
              }

              var to  = from + (this.pagination.offset * 2);
              if(to >= this.pagination.total_pages){
                  to  = this.pagination.total_pages;
              }

              var pagesArray  = [];
              while(from <= to){
                  pagesArray.push(from);
                  from++;
              }

              return pagesArray;
          },
          msjTables : function(){
              var cantIni=1;
              var cantFin=1;
              if(this.pagination.page>1){
                   cantIni=this.pagination.pre_page * this.pagination.per_page;
              }

              if(this.pagination.page ==this.pagination.total_pages){
                  cantFin =this.pagination.total;
              }else{
                  if(this.pagination.page>1){
                      cantFin =cantIni + this.pagination.per_page;
                  }else{
                      cantFin =this.pagination.per_page;
                  }

              }
              var mensaje="Mostrando "+cantIni+" a "+cantFin+" de "+this.pagination.total;
              return mensaje;
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/usuarios/lista';
            this.preload=true;
            console.log('entros');
            axios.post(url,{}).then(response =>{
                this.preload=false;
                console.log("**"+response.data.users);
                this.pagination.data =response.data.users;
                this.changePage(1);

                console.log(this.pagination);
            }).catch(error =>{
                this.preload=false;
            });
          },

          /*metodos de paginacion de tablas*/
          changePage : function (page){
              var data =this.filterData(this.pagination.search,this.pagination.keys,this.pagination.data)
              this.paginator(data,page,this.pagination.per_page);

          },
          changeSearch : function(){
              this.changePage(1);
          },
          paginator  : function (items, page, per_page) {

              var page = page || 1;
              var per_page = per_page || 10;
              var offset = (page - 1) * per_page;

              var paginatedItems = items.slice(offset).slice(0, per_page);
              var total_pages = Math.ceil(items.length / per_page);

              this.pagination.page=page;
              this.pagination.per_page=per_page;
              this.pagination.pre_page=page - 1 ? page - 1 : null;
              this.pagination.next_page= (total_pages > page) ? page + 1 : null;
              this.pagination.total=items.length;
              this.pagination.total_pages=total_pages;
              this.pagination.datafilter=paginatedItems;

          },
          filterData : function(search,keys,wines) {
              var lowSearch = search.toLowerCase();
              return wines.filter(function(wine){
                  return keys.some( key =>
                      String(wine[key]).toLowerCase().includes(lowSearch)
                  );
              });
          }
        }
    }
</script>
