<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChurchController extends Controller
{
    public function index(Request $request)
    {
        $data = new \App\Sermon();
        return view('welcome', compact('data') );
    }

    public function sermons(Request $request)
    {

        $sermons = [];

        $data = new \App\Sermon();

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
       
        return view('sermons', compact('sermons'));
    }
    public function live(Request $request)
    {
        $data = new \App\Sermon();
        return view('live', compact('data'));
    }
}
