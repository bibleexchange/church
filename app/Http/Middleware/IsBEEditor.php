<?php namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Study;

class IsBEEditor {

	public function handle($request, Closure $next){
		
		if($request->study !== null){
			$study = $request->study;
		} else {
			$study = Study::find($request->study_id);
		}
		
		if ( Auth::check() && $study->user_id === Auth::user()->id)
		{
			return $next($request);
		}
		
		return response('Unauthorized.', 401);

	}

}
