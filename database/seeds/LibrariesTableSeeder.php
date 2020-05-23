<?php

use Illuminate\Database\Seeder;

class LibrariesTableSeeder extends Seeder {

    public function run()
    {
        (new App\Library)->seed();
    }

}