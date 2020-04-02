<?php namespace App\Http\Controllers\Bible;

use App\Bookmark;
use Input, Auth, Redirect, Flash;
use Illuminate\Http\Request;

class UserBookmarksController extends Controller {
	
	function __construct(){
		
		$this->middleware('auth');
        
        $this->currentUser = Auth::user();
		
	}

	
	
    public function index()
    {
		return  view('home.bookmarks.index');
    }
	
    public function store(Request $request)
    {	  	
    	$bookmark = new Bookmark;
		$bookmark->url = $request->input('url');

		$bookmark->user_id = Auth::user()->id;
		$bookmark->save();
		
		$request->flash('Your bookmark was saved');
		
		return Redirect::back();
    }
	
	 public function data()
    {
		return $this->currentUser->bookmarks;
    }
	
	/**
	 * Show the form for creating a new resource.
	 * GET /examples/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /examples/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /examples/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /examples/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /examples/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($bookmark)
	{
		$user = Auth::user();
	
		if ($bookmark->user_id === $user->id){
				
			Bookmark::destroy($bookmark->id);
			\Flash::success('Your bookmark has been deleted!');
	
		}else{
	
			\Flash::warning('You don\'t have permission to delete this!');
	
		}
	
		return Redirect::back();
	}
	
}
