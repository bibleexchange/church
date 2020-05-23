<?php namespace App\Http\Controllers;

use App\Commands\LeaveCommentCommand;
use App\Comment;
use Input, Auth, Redirect;

class CommentsController extends Controller {
	
	/**
	 * Leave a new comment.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = array_add(Input::get(), 'user_id', Auth::id());

        $this->dispatch(new LeaveCommentCommand($input));

        return Redirect::back();
	}
	
	public function delete($comment)
	{
			
		$user = Auth::user();   
	
		if ($comment->user_id === $user->id){
				
			Comment::destroy($comment->id);
			request()->flash('message','Your comment has been deleted!');
	
		}else{
	
			request()->flash('error','You don\'t have permission to delete this!');
	
		}
	
		return Redirect::back();
	
	}
	
}
