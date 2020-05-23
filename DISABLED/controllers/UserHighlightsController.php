<?php namespace App\Http\Controllers\Bible;

use App\BibleHighlight as Highlight;
use Input, Auth, Redirect, Flash;

class UserHighlightsController extends Controller {
	
	function __construct(){
		
		$this->middleware('auth');
        
        $this->currentUser = Auth::user();
		
	}

    public function index()
    {
		//return  view('home.bookmarks.index');
    }
	
    public function store()
    {	  	

    	$highlight = Highlight::make(request('bible_verse_id'),Auth::user()->id,request('color'));
		$highlight->save();
		
		request()->flash('message','Your highlight was saved');
		
		return Redirect::back();
    }
	
	 public function data()
    {
		return $this->currentUser->highlights;
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /examples/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($highlight)
	{
		$user = Auth::user();
	
		if ($highlight->user_id === $user->id){
				
			Highlight::destroy($hightlight->id);
			request()->flash('message','Your highlight has been deleted!');
	
		}else{
	
			request()->flash('error','You don\'t have permission to delete this!');
	
		}
	
		return Redirect::back();
	}
	
}
