<?php

function formatHTML($text){

    $data = file_get_contents(dirname(__DIR__)."/config.json");
    $tags = json_decode($data, true);
    $tags = $tags['HTMLTags'];

    for ($i=0; $i < count($tags); $i++) { 
        $text = str_replace($tags[$i]['replace'], $tags[$i]['tags'], $text);
    }

    return trim($text);

}

function findHTMLTags($text){
    $data = file_get_contents(dirname(__DIR__)."/config.json");
    $tags = json_decode($data, true);
    $tags = $tags['HTMLTags'];

    $tagsNote = array();
    

    for ($i=0; $i < count($tags); $i++) { 
        $existTag = strstr($text, $tags[$i]['replace'][0]);
        if($existTag){
            $tagsNote = [$tags[$i]['replace'][0]];
        }
    }

    return $tagsNote;
}