<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomSeriesCourseLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        (new \App\ClassroomSeriesCourseLesson)->schema();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       (new \App\ClassroomSeriesCourseLesson)->drop();
    }
}
