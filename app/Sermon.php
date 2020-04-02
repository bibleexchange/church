<?php

namespace App;

use Cache;

class Sermon
{

    public function __construct(){
        $this->getData();
    }

    public function array(){
        $x = $this->encode($this->data);
        $x = $this->decode($x);
        return $x;
    }

    public function string(){
        $x = $this->encode($this->data);
        return $x;
    }

    //////////////////////////////////////////////////////////////////////////
    public function getData(){
        $this->data = Cache::get('do_xml', function () {
            return simplexml_load_string(@file_get_contents("https://media.deliverance.me"));
        });

        return $this;
    }

    public function encode($data){
        return json_encode($data);
    }

    public function decode($data){
        return json_decode($data,TRUE);
    }

}
