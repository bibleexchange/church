<?php

use Illuminate\Database\Seeder;

class UserPermissionsTableSeeder extends Seeder {

    public function run()
    {
        (new App\UserPermission)->seed();
    }

}