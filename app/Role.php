<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PresentableTrait;
use Schema;

class Role extends Model  implements \App\Interfaces\ModelInterface {

	use PresentableTrait;

	protected $fillable = ['name','description'];

    public function doSchema($table){
         $table->string(‘name’);
         $table->string(‘description’)->nullable();
         return $table;
    }

}
