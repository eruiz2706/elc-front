
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.getData();
    },
    data : {
      courses:[],
      errors :[],
      preload :false,
    },
    computed : {

    },
    methods : {
      getData:function(){
          this.preload=true;
          var url ='home/search';
          axios.post(url,{
            prueba:''
          }).then(response =>{
              this.courses=response.data.data;
              this.preload=false;
              console.log(this.courses);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      search: function(){
      }
    }
});
