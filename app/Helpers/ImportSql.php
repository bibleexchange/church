<?php namespace App\Helpers;

use DB, Config;

class ImportSql {

	private static function memory($message = 'memory'){

		echo "<info>$message</info>" . ': ' . memory_get_usage() . ' bytes (' . memory_get_usage()/1e6 .' mb) ' . ini_get('memory_limit') . ' ' . PHP_EOL;
	}

	public static function import($files){

		static::memory('started run');

    	foreach ($files AS $file_name){
    		$file = file_get_contents($file_name);
    		static::memory('loaded file: ' . $file_name);
    		DB::unprepared(
				$file
			);

			static::memory('after unprepared');

    	}
	}
}