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
                  <p>
                    <strong v-text='traslate.start_date'></strong>
                    <br><span v-text='o_curso.fecha_inicio'></span>
                  </p>
                  <p>
                    <strong v-text='traslate.end_date'></strong>
                    <br><span v-text='o_curso.fecha_finalizacion'></span>
                  </p>
                  <p>
                    <strong v-text='traslate.price'></strong>
                    <br><span v-text="o_curso.valor>0 ? '$'+o_curso.valor :traslate.free"></span>
                  </p>
                </td>
              </tr>
              <tr>
                <th colspan='2' v-if='!subscrip'>
                  <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;" :disabled="loader_suscrip" v-on:click.prevent="suscribirse()" v-if="o_curso.estado !='finalizado' && o_curso.valor==0">
                    <i class="fa fa-thumbs-o-up"></i> <span v-text='traslate.free'></span>
                    <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_suscrip"></i>
                  </button>

                  <form method="post" v-bind:action="webcheckout.action" v-if="o_curso.estado !='finalizado' && o_curso.valor>0">
                     <input name="merchantId"    type="hidden"  v-bind:value="webcheckout.merchantId"   >
                     <input name="accountId"     type="hidden"  v-bind:value="webcheckout.accountId" >
                     <input name="description"   type="hidden"  v-bind:value="webcheckout.description"  >
                     <input name="referenceCode" type="hidden"  v-bind:value="webcheckout.referenceCode" >
                     <input name="amount"        type="hidden"  v-bind:value="webcheckout.amount"   >
                     <input name="tax"           type="hidden"  v-bind:value="webcheckout.tax"  >
                     <input name="taxReturnBase" type="hidden"  v-bind:value="webcheckout.taxReturnBase" >
                     <input name="currency"      type="hidden"  v-bind:value="webcheckout.currency" >
                     <input name="signature"     type="hidden"  v-bind:value="webcheckout.signature"  >
                     <input name="test"          type="hidden"  v-bind:value="webcheckout.test"  >
                     <input name="buyerEmail"    type="hidden"  v-bind:value="webcheckout.buyerEmail" >
                     <input name="responseUrl"    type="hidden" v-bind:value="webcheckout.responseUrl" >
                     <input name="confirmationUrl"    type="hidden" v-bind:value="webcheckout.responseUrl" >
                     <button name="Submit"        type="submit"  class="btn btn-block btn-outline-primary btn-sm">
                        <i class="fa fa-credit-card"></i> <span v-text='traslate.tobuy'></span>
                     </button>
                  </form>
                </th>
                <th colspan='2' v-else>
                  <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;" v-on:click.prevent="iracurso();">
                    <i class="fa fa-thumbs-o-up"></i> <span v-text='traslate.subscribed'></span>
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
      <h3 class="card-title" v-text='traslate.study_plan'>
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
            subscrip:false,
            webcheckout:{},
            traslate:{
              'study_plan':trans('frontend.page_coursedet.study_plan'),
              'feature':trans('frontend.page_coursedet.feature'),
              'start_date':trans('frontend.page_coursedet.start_date'),
              'end_date':trans('frontend.page_coursedet.end_date'),
              'price':trans('frontend.page_coursedet.price'),
              'free':trans('frontend.page_coursedet.free'),
              'tobuy':trans('frontend.page_coursedet.tobuy'),
              'subscribed':trans('frontend.page_coursedet.subscribed'),
            }
          }
        },
        methods : {
          getCurso:function(){
              this.preload=true;
              var url =base_url+'/ofertados/vercurso';
              axios.post(url,{id:this.id_curso}).then(response =>{
                  this.o_curso=response.data.curso;
                  this.subscrip=response.data.subscrip;
                  this.webcheckout=response.data.webcheckout;
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
          },
          iracurso:function(){
            var url =base_url+'/cursos/gestion/'+this.id_curso;
            window.location.href =url;
          }
        }
    }
</script>
