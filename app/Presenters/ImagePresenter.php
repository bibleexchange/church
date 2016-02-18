<?php namespace Deliverance\Presenters;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Image;

class ImagePresenter {

    public function __construct(){
        	
		$this->server = \League\Glide\ServerFactory::create([
					
				'source'=> base_path().'/resources/images',
				'cache'=> storage_path().'/framework/cache/images'
		]);
		
    }
   
    public function outputImage($file, $instructions = null){
    	
    	$image = $this->server->outputImage($file, $instructions);
    	
    	dd($image);
    	
    }
    

}

