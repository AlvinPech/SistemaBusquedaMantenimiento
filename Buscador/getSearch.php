<?php
require_once('semanticExpansion.php');

function getSearch($string, $filters){
  $expandedWords = expand($string);
  $string = str_replace(" ", "/", $string);
  $expandedString = $string.$expandedWords;
  $url1 = 'http://localhost:8983/solr/solrhelp/select?rows=100&fl=*%2Cscore&q=';
  $url2 = '&facet=true&facet.mincount=1&facet.field=title&f.title.facet.limit=5&f.title.facet.sort=count';
  $people_json = file_get_contents($url1.$expandedString.$url2.$filters);
  if (!$people_json) {
    //Si no puede ser expandido
    $people_json = file_get_contents($url1.$string.$url2.$filters);
  }
  $decoded_json = json_decode($people_json, true);

  return $decoded_json;

}
?>
