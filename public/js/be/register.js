
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.row =this.rowbase;
    },
    data : {
      rowbase :{'email':'','password':'','repassword':'','rol':'study'},
      row:{},
      errors :[],
      loader_create :false,
    },
    computed : {

    },
    methods : {
      cleanform : function(){
        this.row =this.rowbase;
        this.errors=[];
        this.loader_create=false;
      },create: function(){
          this.loader_create=true;
          var url ='registerusu';
          axios.post(url,{
            email : this.row.email,
            password :this.row.password,
            repassword :this.row.repassword,
            rol :this.row.rol
          }).then(response =>{
              this.cleanform();
              swal({
                  title:response.data.message,
                  text:response.data.message2,
                  type: "success"
              }, function() {
                  window.location = "login";
              });
          }).catch(error =>{
              this.loader_create=false;
              this.errors=error.response.data.errors;
              console.log(error.response.data.error);
              toastr.error(error.response.data.message,'',{
                  "timeOut": "2500"
              });
          });
      }
    }
});
