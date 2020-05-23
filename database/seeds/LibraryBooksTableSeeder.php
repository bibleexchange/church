<?php

use Illuminate\Database\Seeder;

class LibraryBooksTableSeeder extends Seeder {

    public function run()
    {
        (new App\LibraryBook)->seed();
    }

}