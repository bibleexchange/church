<?php

use Illuminate\Database\Seeder;

class UrlShortsTableSeeder extends Seeder {

    public function run()
    {
        (new App\UrlShort)->seed();
    }

}