<?php
require_once('semanticExpansion.php');
require_once('getSearch.php');

function solrFacet($string){

  $decoded_json = getSearch($string, "");
  $facetArray = $decoded_json['facet_counts']["facet_fields"]['title'];
  $facetQuery = "";
  $facetQuery = '<p class="categoria">Busqueda avanzada</p><br>';

  for ($i=0; $i < count($facetArray); $i++) {
    if ($i%2 == 0) {
      $facetQuery = $facetQuery.'
      <ul>
          <li>
            <input type="checkbox" class="checkbox" value="'.$facetArray[$i].'">
            <label class="label">'.$facetArray[$i].'('.$facetArray[$i+1].')</label>
          </li>
      </ul>';
    }

  }

 //echo $facetQuery;
 return $facetQuery;

}

//solrFacet("badminton");

if( $_REQUEST["name"] ) {
   $string = $_REQUEST['name'];
   $response = solrFacet($string);

   if($response != ""){
     echo $response;
   }else {
     echo "No se ha encontrado contenido";
   }
}


?>
