<?php

use Illuminate\Database\Seeder;

class ClassroomSeriesCoursesTableSeeder extends Seeder {

    public function run()
    {
        (new App\ClassroomSeriesCourse)->seed();
    }

}