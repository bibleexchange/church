<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        (new \App\UserPermission)->schema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       (new \App\UserPermission)->drop();
    }
}
