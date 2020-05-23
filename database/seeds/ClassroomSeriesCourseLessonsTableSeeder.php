<?php

use Illuminate\Database\Seeder;

class ClassroomSeriesCourseLessonsTableSeeder extends Seeder {

    public function run()
    {
        (new App\ClassroomSeriesCourseLesson)->seed();
    }

}