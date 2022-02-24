//Se hace la CORRECION de palabras -->
   $(document).ready(function() {
     $("#send").click(function(event){
       var input = document.getElementById("search_input").value;
       $.get(
         "Buscador/spellcheck.php",
         { name: input },
         function(data) {

           showCorrection(data);
         }
       );
     });

   });

   function showCorrection(data) {
      var x = document.getElementById("opcion");
      if (data != "") {
        x.style.display = "block";
        $('#opcion').html('<p>Quisiste decir: ' + data + '</p>');
        clickCorrection(data);
      }else {
        x.style.display = "none";
      }
    }

    function clickCorrection(data){
      $(document).ready(function() {
        $("#opcion").click(function(event){
          document.getElementById('search_input').value= data;
          document.getElementById('send').click();

          //alert("Hiciste click en la opcion");
        });
      });

    }
