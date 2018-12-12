 <template>
<div>
  <div class="card">
    <div class="card-header card-header-cuorse">
      <h2 class="card-title-course">
        <span v-text='o_curso.nombre'></span>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
          <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
        </button>
      </h2>
    </div>

    <div class="card-body" >
      <div class="row">
        <div class="col-md-8">
          <iframe class="img-fluid" style='width:100%;height:400px' frameborder="0" allowfullscreen allow="autoplay; encrypted-media"
            v-bind:src="o_curso.urlvideo">
          </iframe>
        </div>
        <div class="col-md-4">
          <div class="table-responsive">
            <table class="table no-border">
              <tbody>
              <tr>
                  <td>
                      <img v-bind:src="base_url+'/'+o_curso.imagen"  alt="Ample Admin" class="media-object" style="width: 100%;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                  </td>
              </tr>
              <tr>
                <td>
                  <p style='padding:0px'><strong>FECHA INICIO</strong></p>
                  <span v-text='o_curso.fecha_inicio'></span>
                </td>
              </tr>
              <tr>
                <td>
                  <p><strong>FECHA FINALIZACION</strong></p>
                  <span v-text='o_curso.fecha_finalizacion'></span>
                </td>
              </tr>
              <tr>
                <th colspan='2' v-if='!subscrip'>
                  <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;" :disabled="loader_suscrip" v-on:click.prevent="suscribirse()" v-if="o_curso.estado=='abierto'">
                    <i class="fa fa-thumbs-o-up"></i> Unirse
                    <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_suscrip"></i>
                  </button>

                  <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;" disabled v-else>
                    <i class="fa fa-close"></i> Cerrado
                  </button>
                </th>
                <th colspan='2' v-else>
                  <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;" disabled>
                    <i class="fa fa-thumbs-o-up"></i> Suscrito
                  </button>
                </th>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        Plan de Estudio
      </h3>
    </div>
    <div class="card-body" v-html="o_curso.plan_estudio">
    </div>
  </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component ofertados mounted.');
        },created : function(){
          this.base_url=base_url;
          this.id_curso=document.getElementById('id').value;
          this.getCurso();
        },
        data: function () {
          return {
            loader_suscrip:false,
            id_curso :0,
            o_curso:{},
            preload :false,
            subscrip:false
          }
        },
        methods : {
          getCurso:function(){
              this.preload=true;
              var url =base_url+'/ofertados/vercurso';
              axios.post(url,{id:this.id_curso}).then(response =>{
                  this.o_curso=response.data.curso;
                  this.subscrip=response.data.subscrip;
                  this.preload=false;
              }).catch(error =>{
                  this.preload=false;
                  console.log(error.response.data);
              });
          },
          suscribirse:function(){
            let inst = this;
            swal({
              title: "Seguro deseas suscribirte",
              text: "",
              type: "info",
              showCancelButton: true,
              confirmButtonClass: "btn-success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true
            },
            function(){
              inst.enviarSuscripcion();
            });
          },
          enviarSuscripcion:function(){
            this.loader_suscrip=true;
            let inst = this;
            var url =base_url+'/ofertados/suscrip';
            axios.post(url,{idcurso:this.id_curso}).then(response =>{
                this.loader_suscrip=false;
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                  inst.$root.$emit('setReload');
                  inst.redirectVolver();
                });
            }).catch(error =>{
                this.loader_suscrip=false;
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "2500"
                  });
                }
            });
          },
          redirectVolver:function(){
            document.getElementById('id').value='';
            this.$root.$emit('setMenu','ofertados');
          }
        }
    }
</script>
