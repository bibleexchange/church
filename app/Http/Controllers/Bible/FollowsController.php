<?php namespace App\Http\Controllers\Bible;

use App\Bible\Commands\FollowUserCommand;
use App\Bible\Commands\UnfollowUserCommand;
use Input,Auth, Flash, Redirect;

class FollowsController extends Controller {

	/**
	 * Follow a user.
	 *
	 * @return Response
	 */
	public function store()
	{
		
        $lesson = $this->dispatch(new FollowUserCommand(Auth::user()->id, Input::get('userIdToFollow')));
         
         Flash::success('You are now following this user.');
        
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

        $this->dispatch(new UnfollowUserCommand(Auth::id(),Input::get('userIdToUnfollow')));

        Flash::success('You have now unfollowed this user.');

        return Redirect::back();
	}


}
