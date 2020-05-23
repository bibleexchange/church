<?php

use Illuminate\Database\Seeder;

class LibraryBookChaptersTableSeeder extends Seeder {

    public function run()
    {
        (new App\LibraryBookChapter)->seed();
    }

}