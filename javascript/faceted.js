

$(document).ready(function() {
  $("#send").click(function(event){
    var input = document.getElementById("search_input").value;
    $.get(
      "Buscador/faceted.php",
      { name: input },
      function(data) {
        $('#facetedDiv').html(data);
        check();
      }
    );
  });

});

function searchFaceted(filter){
  //Una vez obtenido el array se hace la busqueda facetada
  var input = document.getElementById("search_input").value;
  $.get(
    "Buscador/search.php",
    { name: input,
      filters: filter},
    function(data) {
      $('#results').html(data);
      //alert(data);
    }
  );
}

function check(){
  var valueList = document.getElementById('item-list');
  var text = '<span> seleccionados: </span>';
  var listArray = [];

  var checkboxes = document.querySelectorAll('.checkbox');

  for (var checkbox of checkboxes) {
    checkbox.addEventListener('click', function(){
      if (this.checked == true) {
        listArray.push(this.value);
      }else {
        listArray = listArray.filter(e => e !== this.value);
      }

      var filter = " ";
      if (listArray.length > 0) {
        filter = "&fq=title:" + listArray.toString();
      }

      searchFaceted(filter);


    });



  }

}
