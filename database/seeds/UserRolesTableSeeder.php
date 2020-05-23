<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder {

    public function run()
    {
        (new App\UserRole)->seed();
    }

}