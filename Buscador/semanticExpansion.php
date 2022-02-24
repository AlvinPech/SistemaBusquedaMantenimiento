<?php


function expand($string){
  $expanded = "";
  $string = str_replace(" ", "%20", $string);
  $people_json = file_get_contents('https://api.datamuse.com/words?ml='.$string.'&v=es&max=5');
  $decoded_json = json_decode($people_json, true);
  foreach($decoded_json as $word){
    $expanded = $expanded."+".$word['word'];
  }
  return $expanded;
}


?>
