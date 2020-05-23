<?php

use Illuminate\Database\Seeder;

class BibleDatabaseTableSeeder extends Seeder {



    public function run()
    {

        //Have to increase max_packet_allowed size to greater than 5mb
        //in mysql global variable
        $files = Config::get('seeds')['SCRIPTURE'];
        \App\Helpers\ImportSql::import($files);
    }

}