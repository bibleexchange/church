<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EvernoteServiceProvider extends ServiceProvider {

    public function register()
    {
		
		$this->app->singleton('Evernote',function(){			
			return new App\Helpers\Evernote;
		});
	
    }
}