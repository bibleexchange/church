<?php namespace App\Repository\Statement;

use DB;
use \Illuminate\Database\Eloquent\Model as Model;
use \App\Helpers\Helpers as Helpers;
use \App\Helpers\Exceptions as Exceptions;
use \App\Statement;

abstract class EloquentReader {
  protected $model = '\App\Statement';

  /**
   * Constructs a query restricted by the given options.
   * @param [String => Mixed] $opts
   * @return \Jenssegers\Mongodb\Eloquent\Builder
   */
  protected function where(Options $opts) {
    $scopes = $opts->getOpt('scopes');
    $query = (new $this->model)->where('lrs_id', $opts->getOpt('lrs_id'));

    if (in_array('all', $scopes) || in_array('all/read', $scopes) || in_array('statements/read', $scopes)) {
      // Get all statements.
    } else if (in_array('statements/read/mine', $scopes)) {
      $query = $query->where('client_id', $opts->getOpt('client')->id);
    } else {
      throw new Exceptions\Exception('Unauthorized request.', 401);
    }

    return $query;
  }

  /**
   * Gets the statement from the model as an Object.
   * @param Model $model
   * @return \stdClass
   */
  protected function formatModel(Model $model) {
    return Helpers::replaceHtmlEntity($model->statement);
  }

  public function getCollection(){
    return Statement::all();
  }
}
