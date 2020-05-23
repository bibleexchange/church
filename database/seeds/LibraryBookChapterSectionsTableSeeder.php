<?php

use Illuminate\Database\Seeder;

class LibraryBookChapterSectionsTableSeeder extends Seeder {

    public function run()
    {
        (new App\LibraryBookChapterSection)->seed();
    }

}