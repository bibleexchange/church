<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        (new \App\Media)->schema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       (new \App\Media)->drop();
    }
}
