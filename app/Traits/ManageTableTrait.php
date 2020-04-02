<?php namespace App\Traits;

use Schema;

trait ManageTableTrait {

    public function create(){
        Schema::create(‘roles’, function (Blueprint $table) {
         $table->increments(‘id’);
         $table = $this->doSchema();
         $table->timestamps();
        });
    }

    public function destroy(){
        Schema::dropIfExists($this->getTable());
    }

}
