<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder {

    public function run()
    {
        (new App\Job)->seed();
    }

}