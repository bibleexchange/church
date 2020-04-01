<?php namespace App\Bible\Providers;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind('search','App\Services\Search');
	}


}