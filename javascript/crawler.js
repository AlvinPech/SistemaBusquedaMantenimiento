$(document).ready(function() {
  $("#crawler").click(function(event){
    //alert("Div");
    var x = document.getElementById("charge");
    x.style.display = "block";


    $.get(
      "Crawler/crawler.php",
      { name: "true"},
      function(data) {
        //alert(data);
        showCorrection(data);
      }
    );
  });

});

function showCorrection(data) {
   var x = document.getElementById("charge");
     x.style.display = "none";
   
 }
