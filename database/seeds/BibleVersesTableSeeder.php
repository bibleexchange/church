<?php

use Illuminate\Database\Seeder;

class BibleVersesTableSeeder extends Seeder {

    public function run()
    {
        (new App\BibleVerse)->seed();
    }

}