<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder {

    public function run()
    {
        (new App\Tag)->seed();
    }

}