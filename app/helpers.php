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

function categoryIcon($category) {
    switch($category){
        case 'Comidas': 
            return '<i class="fas fa-utensils"></i>';
        case 'Viajes':
            return '<i class="fas fa-plane"></i>';
        case 'Trabajo':
            return '<i class="fas fa-briefcase"></i>';
        default:
            return '<i class="far fa-comment-dots"></i>';
    }
}