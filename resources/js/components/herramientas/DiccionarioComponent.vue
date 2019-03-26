<template>
<div>
  <div class="row justify-content-center" style="padding-top:10%" v-if="!open_dicc">
      <div class="col-12 col-md-10 col-lg-8">
          <form class="card card-sm">
              <div class="card-body row no-gutters align-items-center">
                  <div class="col-auto">
                      <i class="fa  fa-search"></i>
                  </div>
                  <div class="col">
                      <input class="form-control form-control-lg form-control-borderless" type="search" v-bind:placeholder="traslate.search_keyword" v-model="palabra_clave">
                  </div>
                  <div class="col-auto">
                      <button class="btn btn-lg btn-success " v-on:click.prevent="busqueda();"><span v-text='traslate.search'></span></button>
                  </div>
              </div>
          </form>
      </div>
      <!--end of col-->
  </div>
  <center v-if="open_dicc">
    <iframe v-bind:src="url_dicc"  frameborder="0" allowfullscreen></iframe>
  </center>
</div>
</template>

<script>


    export default {
        mounted() {

        },created : function(){
          this.base_url=base_url;
          this.url_dicc='https://www.wordreference.com/es/translation.asp';
        },
        data: function () {
          return {
            url_dicc:'',
            palabra_clave:'',
            open_dicc:false,
            traslate:{
              'search_keyword':trans('backend.search_keyword'),
              'search':trans('backend.search'),
            }
          }
        },
        methods : {
          busqueda:function(){
            var palabra_clave=this.palabra_clave;
            this.url_dicc +="?tranword="+palabra_clave.replace(/' '/g,'%20');
            this.open_dicc=true;
          }
        }
    }
</script>
