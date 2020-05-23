<?php

use Illuminate\Database\Seeder;

class ClassroomsTableSeeder extends Seeder {

    public function run()
    {
        (new App\Classroom)->seed();
    }

}