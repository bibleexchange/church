<?php namespace App\Traits;

use DB, Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;

trait ManageTableTrait {

    public function truncate(){
        Schema::disableForeignKeyConstraints();
        DB::table($this->getTable())->truncate();
        Schema::enableForeignKeyConstraints();
        return true;
    }
    
    public function drop(){
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists($this->getTable());
        Schema::enableForeignKeyConstraints();
        return true;
    }

    public function schema(){
        Schema::create($this->getTable(), function(Blueprint $table)
        {
          $table = $this->modifySchema($table);
        });

        $this->afterSchema();

        return true;
    }
    
    public function seed(){
        $this->truncate();

        $seeds = $this->getSeed();

          foreach($seeds AS $seed){
            $model = static::create($seed);
          }

          return true;
    }

  public function getSeed(){
    return [];
  }

public function afterSchema(){
    //empty
  }
  
}
