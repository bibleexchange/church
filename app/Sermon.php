<?php

namespace App;

class Sermon
{
    public static function xml(){
        $xml = simplexml_load_string(@file_get_contents("https://media.deliverance.me"));
        $json = json_encode($xml);
        return json_decode($json,TRUE)["Contents"];
    }
}
