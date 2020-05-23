<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomSeriesCourseLessonActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        (new \App\ClassroomSeriesCourseLessonActivity)->schema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       (new \App\ClassroomSeriesCourseLessonActivity)->drop();
    }
}
