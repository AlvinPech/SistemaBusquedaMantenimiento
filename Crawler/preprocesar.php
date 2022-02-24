<?php

require_once '../vendor/autoload.php';
use ICanBoogie\Inflector;


function rip_tags($string) {
  // ----- remove HTML script ans style -----
  $string =preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/is', "", $string);
  // ----- remove HTML TAGs -----
  $string = preg_replace ('/<[^>]*>/', ' ', $string);
  // ----- remove control characters -----
  $string = str_replace("\r", '', $string);    // --- replace with empty space
  $string = str_replace("\n", ' ', $string);   // --- replace with space
  $string = str_replace("\t", ' ', $string);   // --- replace with space
  $string = delete_accents($string);

  $string = preg_replace("/[^a-zA-Z0-9\s]+/", "", $string);
  // ----- remove multiple spaces -----
  $string = trim(preg_replace('/ {2,}/', ' ', $string));

  //$language = getLanguage($string);
  $string = remove_stop_words($string, "es");


  return $string;
}

function convert_min($string){
  $resStr = mb_strtolower($string);
  return $resStr;
}

function getLanguage($string){
  $detector = new LanguageDetector\LanguageDetector();
  $language = $detector->evaluate($string)->getLanguage();
  return $language; // Prints something like 'en'
}

function delete_accents($cadena){

		//Reemplazamos la A y a
		$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
		);

		//Reemplazamos la E y e
		$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena );

		//Reemplazamos la I y i
		$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena );

		//Reemplazamos la O y o
		$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena );

		//Reemplazamos la U y u
		$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena );

		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
		$cadena
		);

		return $cadena;
	}

  function remove_stop_words($words, $lang) {
    if($lang !== "es" ){
        return $words;
    }

    $stop_words = require('locale/' . "es" . '.php');
    foreach ($stop_words as &$word) {
        $word = '/\b' . preg_quote($word, '/') . '\b/iu';
    }

    return preg_replace($stop_words, '', $words);

  }


  function Singular($page, $lang){
      $language = strval($lang);
      if( $lang != "en" && $lang != "es" ){
          return $page;
      }
      $words = explode(" ",$page);
      $inflector = Inflector::get();
      $page = "";
      foreach ($words as $key => $word) {
          $wordSingular= $inflector->singularize($word,$language);
          $page = $page." ".$wordSingular;
      }
      return $page;
  }


?>
