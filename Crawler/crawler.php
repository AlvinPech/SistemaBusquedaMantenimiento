<?php
# Librerias
include("../LIB/LIB_http.php");
include("../LIB/LIB_parse.php");
include("../LIB/LIB_resolve_addresses.php");
include("../LIB/LIB_http_codes.php");

# Tiempo de ejecucion
set_time_limit(180);

# Archivos requeridos
require_once('preprocesar.php');
require_once('indexer.php');

# Se leen los links del archivo
$file = file_get_contents("../links.txt");
$txtLinks = explode(PHP_EOL, $file);

if (isset($_GET['name'])) {
  global $txtLinks;
	crawl_txt($txtLinks, 2);
  echo "Crawling finalizado";
}





# Se hace el crawling de los links en el archivo
function crawl_txt($txtLinks, $depth){
  //Links del archivo
  foreach ($txtLinks as $key) {
        $crawled = crawlNextLevel($key);
        crawl_link($crawled);
  }
}

# Se hace el crawlink para el siguiente niveles
function crawl_link($urlArray){
    foreach ($urlArray as $key) {
        $crawled = crawlNextLevel($key);
    }
}

# Vamos al/los siguientes niveles
function crawlNextLevel($urlBase){
    $url = $urlBase;
    $filtro  = array("/img/", ".png", ".jpg", ".pdf", ".zip", ".docx" , ".webp");
    $page_base = get_base_page_address($url);
    $downloaded_page = http_get($url, "");

    //Obtengo el array de links que tenga la pagina
    $crawled = array_unique(getLinks($downloaded_page, $page_base));
    //Obtengo el titulo del archivo
    $title_excl = rip_tags(return_between($downloaded_page['FILE'], "<title>", "</title>",EXCL));
    //Preproceso la pagina
    $script = rip_tags(convert_min($downloaded_page['FILE']));

    //Imprimo el contenido
    if (!strposmult($url, $filtro, 1) && getPageStatus($url) >= 200 && getPageStatus($url) < 400) {
        //echo "<br><br>Base: ".$url."<br>";
        //echo "Titulo: ".$title_excl."<br><br>";
        //echo $script;


        # Añado el documnto a solr
        addDocumentSolr($url, $title_excl, $script);
    }

    return array_unique($crawled);

}

# Se obtienen los links que contenga la pagina
function getLinks($downloaded_page, $page_base){
  $link_array = array();
  $anchor_tags = parse_array($downloaded_page['FILE'], "<a", "</a>", EXCL);
  for($xx=0; $xx<count($anchor_tags); $xx++){
      $href = get_attribute($anchor_tags[$xx], "href");
      $resolved_addres = resolve_address($href, $page_base);
      //$new_page = http_get($resolved_addres, $page_base);
      if ($resolved_addres != $page_base) {
        array_push($link_array, $resolved_addres);
      }
  }

  return array_unique($link_array);
}

#Esta funcion filtra ciertas palabras en la url para evitar que escanee sitios con codigo de imagenes
function strposmult($haystack, $needles=array(), $offset=0) {
        $chr = array();
        foreach($needles as $needle) {
                $res = strpos($haystack, $needle, $offset);
                if ($res !== false){
                	$chr[$needle] = $res;
                }
        }
        if(empty($chr)){
        	return false;
        }
        return min($chr);
}

#Esta funcion filtra los enlaces que se encuentran rotos o redireccionan
function getPageStatus($url){
    // init curl object
    $ch = curl_init();

    // define options
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );

    // apply those options
    curl_setopt_array($ch, $optArray);

    // execute request and get response
    $result = curl_exec($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return $response;
}
?>
