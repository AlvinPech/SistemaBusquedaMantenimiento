<!DOCTYPE html>
<html>
    <head>

        <!-- Jquery CDN-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Bootstrap CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

        <script src="includes/plugins/highlight/highlight.js"></script>

        <script src="includes/index.js"></script>

    </head>
    <body>
        <main class="container">
            <div class="page-header">
                <div class="row">
                    <div class="col-10">
                        <h1>Añadir o remover links</h1>
                    </div>
                </div>
                <br />
            </div>
            <!-- Barra de busqueda del formulario-->
            <div class="center">
              <form class="form-search" method="post" id="formSearch">
                <div class="input-group">
                  <textarea rows="4" cols="100" name="linkWord" id="txtSearch"><?php
                   $URLfile = "links.txt"; 
                   if (file_exists($URLfile)) {
                        error_reporting(0);
                        $URLfile = fopen("links.txt", "r") or die("Unable to open file!");
                        echo fread($URLfile,filesize("links.txt"));
                        fclose($URLfile);
                   }?></textarea>
                  </div>
                  <input type="submit" class="btn btn-primary" name="URIList" value="Actualizar">
                  <?php
                  if (isset($_POST['URIList'])) {
                        addUrlToTxt();
                  }
                  ?> 
                 <input type="submit" class="btn btn-success" name="volver" value="Regresar al inicio" onclick="window.history.go(-1); return false;">
              </form>
                  
            </div>
            <div id="searchResults">
              <?php
              $URLfile = "links.txt";
              if (file_exists($URLfile)) {
                  readTxt();
              }
              ?>
            </div>
        </main>

        <?php
       
        function addUrlToTxt(){
            if(!file_exists("links.txt")){
                $file = tmpfile();
            }
            $file = fopen("links.txt","wb+");
            while(!feof($file)){
                fgets($file);
            }
            $text = $_POST["linkWord"];
            file_put_contents("links.txt",$text);
            fclose($file);
        }

        function readTxt(){
          unset($_POST);
          //Leemos el archivo txt
          $file = fopen("links.txt", "r");

          while(!feof($file)) {
            echo fgets($file). "<br />";
          }       

          fclose($file);
        }
        ?>

    </body>
</html>