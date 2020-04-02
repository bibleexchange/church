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
        $data = new \App\Sermon();
        return view('sermons', compact('data'));
    }
    public function live(Request $request)
    {
        $data = new \App\Sermon();
        return view('live', compact('data'));
    }
}
