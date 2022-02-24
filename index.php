<html>
   <head>
      <title>Buscador</title>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/style.css">
      <script src="javascript/script.js" defer></script>
      <script src="https://kit.fontawesome.com/7919fb354a.js" crossorigin="anonymous"></script>
      <!-- jQuery -->
      <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

      <!-- jQuery UI -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
   </head>

   <body>

     <nav class="navbar">
         <div class="logo">Buscador</div>
         <a href="#" class="toggle-btn">
             <span class="bar"></span>
             <span class="bar"></span>
             <span class="bar"></span>
         </a>
         <div class="navbar-links">
             <ul>
                 <li><a href="index.php">Inicio</a></li>
                 <li><a href="links.php">Links</a></li>
             </ul>
         </div>
     </nav>

     <div class="search">
         <form autocomplete="off" onsubmit=""  action="" name="search-form" id="search-form" method="get">
             <input type="text" name="search_input" id="search_input" class="input" placeholder="Buscar en la Web">
             <div class="searchbtn" title="Buscar" id="send">
                 <i class="fas fa-search"></i>
             </div>

         </form>

     </div>




     <div class="results" >
       <div class="correccion" >
          <div class="opcion" id="opcion">

          </div>
      </div>
      <div id="results">
        <div class="opcion">
          <p>No hay nada que mostrar!</p>
        </div>

      </div>
     </div>


     <div class="left">
         <div class="advance-search" id="facetedDiv">
           <p class="categoria">Busqueda avanzada</p><br>

         </div>
     </div>


     <!-- Se hace la sugerencia de palabras -->
     <script src="javascript/suggestions.js"></script>
     <!-- Se hace la correcion de palabras -->
     <script src="javascript/spellCorrection.js"></script>
     <!-- Se hace la busqueda facetada palabras -->
     <script src="javascript/faceted.js"></script>
     <!-- Se hace la bsuqueda de palabras -->
     <script src="javascript/search.js"></script>





   </body>
</html>
