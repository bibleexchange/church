<?php namespace App\Http\Controllers;

use App\Helpers\UserRepository;
use App\Helpers\Page;
use \App\User;

class UsersController extends Controller {

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::getPaginated(15);
        return view('users.index')->withUsers($users);
	}

    /**
     * Display a user's profile.
     *
     * @param $username
     * @return mixed
     */
    public function show($username)
    {
        $user = User::findByUsername($username);
    	$notes_per_page = 5;
    	$data_path = '/api/v1/notes/@'.$username;

        return view('users.show',compact('user','notes_per_page','data_path'));
    }
	
    public function notes($username)
    {
    	
    	$user = User::findByUsername($username);
    	$notes = $user->notes;
    	$notes_per_page = 5;
    	$data_path = '/api/v1/notes/@'.$username;
    	
    	$page = new Page;
    	$page->make($notes->first());
    	
    	return view('users.notes', compact('user','notes','page','notes_per_page','data_path'));
    }
    
    public function amens($username)
    {
    	$user = User::findByUsername($username);
    	$amens = $user->amens;
    	
    	$page = new Page;
    	$page->make($user);
    	
    	$amens_per_page = 5;
    	$data_path = '/api/v1/amens/@'.$username;
    	 
    	return view('amens.amens', compact('user','amens','page','amens_per_page','data_path'));
    }
    
    public function following($username)
    {
    	$user = User::findByUsername($username);
    	$users_list = $user->followedUsers;
    	
    	$page = new Page;
    	$page->make($user);

    	return view('users.followers', compact('user','users_list','page'));
    }
    
    public function followers($username)
    {
    	$user = User::findByUsername($username);
    	$users_list = $user->followers;

    	$page = new Page;
    	$page->make($user);
    	
    	return view('users.followers', compact('user','users_list','page'));
    }
    
    /**
     * Display a user's individual note
     * @param $user
     * @param $note
     */
    public function note($username, $note)
    {
    	$user = User::findByUsername($username);
    	$notes[0] = $user->notes()->where('id',$note->id)->first();
    	
    	$page = new Page;
    	$page->make($notes[0]);
    	
    	return view('users.note', compact('user','notes','page'));
    }    
 
}
