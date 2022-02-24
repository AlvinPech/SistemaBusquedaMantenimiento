<?php

function addDocumentSolr($link, $title, $description){

  if ($link !== "" && $title !== "" && $description !== "") {
    $ch = curl_init("http://localhost:8983/solr/solrhelp/update?commitWithin=1000&overwrite=true&wt=json");

    $data = array(
        "add" => array(
            "doc" => array(

                "title" => $title,
                "link" => $link,
                "description" => $description

            ),
            "commitWithin" => 1000,
        ),
    );
    $data_string = json_encode($data);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    $response = curl_exec($ch);
  }



}


?>
