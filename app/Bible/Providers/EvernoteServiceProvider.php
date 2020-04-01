<?php namespace App\Bible\Providers;

use Illuminate\Support\ServiceProvider;

class EvernoteServiceProvider extends ServiceProvider {

    public function register()
    {
		
		$this->app->bindShared('Evernote',function(){			
			return new App\Bible\Helpers\Evernote;
		});
	
    }
}