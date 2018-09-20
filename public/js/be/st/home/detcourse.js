
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      var id=document.getElementById('id').value;
      this.titulo=id;
    },
    data : {
      courses:[],
      errors :[],
      preload :false,
      titulo : ''
    },
    computed : {

    },
    methods : {
    }
});
