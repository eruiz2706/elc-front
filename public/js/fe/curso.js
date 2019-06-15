function busqueda(){
  var select=document.getElementById('courses_search_select').value;
  var url=base_url+"/cursosd/"+select;
  window.location.href =url;
}
