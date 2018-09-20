
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.getData();
    },
    data : {
      user:{},
      errors :[],
      preload :false,
      imagusu:''
    },
    computed : {

    },
    methods : {
      updateImage:function(){
        const formData = new FormData();
        formData.append(imagusu,imagusu);
        console.log(imagusu.value);
      },
      getData:function(){
          this.preload=true;
          var url ='profile/info';
          axios.post(url,{
            prueba:''
          }).then(response =>{
              this.preload=false;
              this.user=response.data.user;
              console.log(this.user);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      search: function(){
      }
    }
});
