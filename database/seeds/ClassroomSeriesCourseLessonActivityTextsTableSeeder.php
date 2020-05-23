<?php

use Illuminate\Database\Seeder;

class ClassroomSeriesCourseLessonActivityTextsTableSeeder extends Seeder {

    public function run()
    {
        (new App\ClassroomSeriesCourseLessonActivityText)->seed();
    }

}