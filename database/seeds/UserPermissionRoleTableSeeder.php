<?php

use Illuminate\Database\Seeder;

class UserPermissionRoleTableSeeder extends Seeder {

    public function run()
    {
        (new App\UserPermissionRole)->seed();
    }

}