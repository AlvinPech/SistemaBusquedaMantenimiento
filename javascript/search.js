$(document).ready(function() {
  $("#send").click(function(event){
    var input = document.getElementById("search_input").value;
    //alert(input);
    $.get(
      "Buscador/search.php",
      { name: input,
        filters: " "},
      function(data) {
        $('#results').html(data);
        //showCorrection(data);
      }
    );
  });

});
