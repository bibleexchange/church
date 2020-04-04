<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChurchController extends Controller
{
    public function index(Request $request)
    {
       $sermons = \App\Sermon::prepare();
        return view('welcome', compact('sermons') );
    }

    public function sermons(Request $request)
    {
        $sermons = \App\Sermon::prepare();
        return view('sermons', compact('sermons'));
    }
    public function live(Request $request)
    {
        $sermons = \App\Sermon::prepare();
        return view('live', compact('sermons'));
    }
}
