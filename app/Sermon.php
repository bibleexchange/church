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

    public static function prepare(){
         $sermons = [];

        $data = new static();

        $i=0;
        foreach($data->data->Contents AS $c){

            $s = new \stdclass;
            $s->Key = (String) $c->Key;

            $id = explode("/", $c->Key);

            if(count($id) === 2 && $id[1] !== ""){
           
                $id = explode('.',$id[1]);
                $rec = \App\Recording::where('date','LIKE','%'.$id[0].'%')->first();

                if(is_object($rec)){
                    $s->Title = $rec->title;
                }else{
                    $s->Title= $id;
                }
                
            }else{
                 $s->Title = $id[0];
            }
            $sermons[$i] = $s;
            $i++;
        }

        return $sermons;
    }

}
