<?php

use Illuminate\Database\Seeder;

class UserRoleUserTableSeeder extends Seeder {

    public function run()
    {
        (new App\UserRoleUser)->seed();
    }

}