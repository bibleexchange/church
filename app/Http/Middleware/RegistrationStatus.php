<?php namespace App\Http\Middleware;

use Closure;

class RegistrationStatus {

	public function handle($request, Closure $next)
	{
		
		/*
		|---------------------------------------------------------------------------
		| Check whether registration has been enabled
		|---------------------------------------------------------------------------
		*/

		$site = \App\Site::first();

		  if( $site !== null){
			if( $site->registration != 'Open' ) return \Redirect::to('/');
		  }

		return $next($request);
	}

}
