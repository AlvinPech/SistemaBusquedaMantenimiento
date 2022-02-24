<?php

function suggestions($string){
  $people_json = file_get_contents('http://localhost:8983/solr/solrhelp/suggest?suggest=true&suggest.build=true&suggest.dictionary=mySuggester&wt=json&suggest.q='.$string);
  $decoded_json = json_decode($people_json, true);
  $spellArray = $decoded_json['suggest']["mySuggester"][$string]["suggestions"];

  return $spellArray;

}

if (isset($_GET['term'])) {
	$getSuggest = suggestions($_GET['term']);
	$suggestList = array();
	foreach($getSuggest as $suggest){
		$suggestList[] = $suggest['term'];
	}
	echo json_encode($suggestList);
}

?>
