<?php
require_once('semanticExpansion.php');
require_once('getSearch.php');

function solrSearch($string, $filters){

  $decoded_json = getSearch($string, $filters);
  $spellArray = $decoded_json['response']["docs"];
  $htmlQuery = "";
  $dataArray = array();

  //
  foreach($spellArray as $suggest){
    $htmlQuery = $htmlQuery.
    '<div class="info">
        <ul>
            <li><p>'.$suggest['link']['0'].'</p></li>
            <li><a href="'.$suggest['link']['0'].'" target="_blank">'.$suggest['title']['0'].'</a></li>
            <li><p>'.substr($suggest['description']['0'], 0, 200).'...</p></li>
            <li><p>Score: '.$suggest['score'].'</p></li>
        </ul>
    </div><br>';
  }


 return $htmlQuery;

}

//solrSearch("Chainsaw");

if( $_REQUEST["name"] && $_REQUEST["filters"]) {
   $string = $_REQUEST['name'];
   $filters = $_REQUEST['filters'];
   $response = solrSearch($string, $filters);

   if($response != ""){
     echo $response;
   }else {
     echo "";
   }
}



?>
