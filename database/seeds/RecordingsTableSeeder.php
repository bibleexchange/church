<?php

use Illuminate\Database\Seeder;

class RecordingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new App\Recording)->seed();
    }
}
