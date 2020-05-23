<?php

namespace App\Providers;

use App\GraphQL\Schema\GraphQL;
use App\GraphQL\Commands\FieldMakeCommand;
use App\GraphQL\Commands\MutationMakeCommand;
use App\GraphQL\Commands\QueryMakeCommand;
use App\GraphQL\Commands\SchemaCommand;
use App\GraphQL\Commands\TypeMakeCommand;
use App\GraphQL\Commands\CacheCommand;
use App\GraphQL\Schema\Parser;
use App\GraphQL\Schema\SchemaContainer;

use Illuminate\Support\ServiceProvider;

class RelayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerSchema();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('relay', function ($app) {
            return new GraphQL($app);
        });

    }

    /**
     * Register schema mutations and queries.
     *
     * @return void
     */
    protected function registerSchema()
    {
        //$this->initializeTypes();
    }

    /**
     * Initialize GraphQL types array.
     *
     * @return void
     */
    protected function initializeTypes()
    {
       foreach (config('graphql.types') as $name => $type) {
		  $this->app['relay']->addType($type, $name);            
	}

    }
}
