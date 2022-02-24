<?php

function solrSpellCheck($string){
  $people_json = file_get_contents('http://localhost:8983/solr/solrhelp/spell?q='.$string);
  $decoded_json = json_decode($people_json, true);
  $spellArray = $decoded_json['spellcheck']["suggestions"]["1"]["suggestion"];
  $dataArray = array();

  foreach($spellArray as $suggest){
    array_push($dataArray, $suggest['word']);
  }
  return $dataArray[0];

}

if( $_REQUEST["name"] ) {

   $string = $_REQUEST['name'];
   $response = solrSpellCheck($string);

   if($response != ""){
     echo $response;
   }else {
     echo "";
   }


   //echo "<h1>".solrSpellCheck($string)."</h1>";
}





?>
