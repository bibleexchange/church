<?php namespace App\Http\Controllers\Bible;

use App\Bible\Commands\AmenObjectCommand;
use App\Bible\Commands\UnamenObjectCommand;
use Input,Auth, Flash, Redirect;

class AmensController extends Controller {
	
	public function __construct(){
		
		$this->middleware('auth');
		
		$this->currentUser = Auth::user();
		
	}
	
	/**
	 * Amen an Object
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$amen = $this->dispatch(new AmenObjectCommand(Auth::user(), request('amenable_type'), request('amenable_id')));
        
         request()->session('message','Amen!');
        
        return Redirect::back();       

	}

    /**
     * Unamen an Object
     *
     * @param $userIdToUnfollow
     * @internal param int $id
     * @return Response
     */
	public function destroy()
	{

        $this->dispatch(new UnamenObjectCommand(Auth::user(), request('amenable_type'), request('amenable_id')));

        request()->session('message','You have removed your amen.');

        return Redirect::back();
	}


}
