<?php namespace App\Http\Controllers;

use App\Commands\FollowUserCommand;
use App\Commands\UnfollowUserCommand;
use Input,Auth, Flash, Redirect;

class FollowsController extends Controller {

	/**
	 * Follow a user.
	 *
	 * @return Response
	 */
	public function store()
	{
		
        $lesson = $this->dispatch(new FollowUserCommand(Auth::user()->id, request('userIdToFollow')));
         
         request()->session('message','You are now following this user.');
        
        return Redirect::back();       

	}

    /**
     * Unfollow a user.
     *
     * @param $userIdToUnfollow
     * @internal param int $id
     * @return Response
     */
	public function destroy()
	{

        $this->dispatch(new UnfollowUserCommand(Auth::id(),request('userIdToUnfollow')));

        request()->session('message','You have now unfollowed this user.');

        return Redirect::back();
	}


}
