<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Fetch\NotificationFetcher;

class UserController extends Controller
{

    function __construct()
    {        
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

    	if($user && $user->isSetup() && $user->isConfirmed()){
			
    		$notifications = new NotificationFetcher($user);
			$notifications = $notifications->onlyUnread()->fetch();
    		$notes = \App\Helpers\NoteRepository::getFeedForUser($user);
    		$notes_per_page = 5;
    		$data_path = '/user/notes/data';

    		return view('home.home',compact('notifications','notes','notes_per_page','data_path'));
    	}
        
    	return view('home.index');
    }

    public function home(){
        return $this->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
