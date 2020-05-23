<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

  public function register(){

    $this->app->bind(
      'App\Repository\User\UserRepository',
      'App\Repository\User\EloquentUserRepository'
    );
    $this->app->bind(
      'App\Repository\Statement\EloquentRepository',
      'App\Repository\Statement\EloquentRepository'
    );
    $this->app->bind(
      'App\Repository\Lrs\Repository',
      'App\Repository\Lrs\EloquentRepository'
    );
	$this->app->bind(
      'App\Repository\Client\Repository',
      'App\Repository\Client\EloquentRepository'
    );
    $this->app->bind(
      'App\Repository\Site\SiteRepository',
      'App\Repository\Site\EloquentSiteRepository'
    );
    $this->app->bind(
      'App\Repository\Query\QueryRepository',
      'App\Repository\Query\EloquentQueryRepository'
    );
    $this->app->bind(
      'App\Repository\Document\DocumentRepository',
      'App\Repository\Document\EloquentDocumentRepository'
    );
    $this->app->bind(
      'App\Repository\OAuthApp\OAuthAppRepository',
      'App\Repository\OAuthApp\EloquentOAuthAppRepository'
    );
    $this->app->bind(
      'App\Repository\Report\Repository',
      'App\Repository\Report\EloquentRepository'
    );
    $this->app->bind(
      'App\Repository\Export\Repository',
      'App\Repository\Export\EloquentRepository'
    );
  }

  public function map()
	{
		
	}
  
}