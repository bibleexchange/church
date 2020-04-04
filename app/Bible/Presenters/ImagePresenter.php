<?php namespace App\Bible\Presenters;

use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class ImagePresenter extends Presenter {

    public function __construct(){
        //https://glide.thephpleague.com
		$this->server = ServerFactory::create([
					
				'source'=> base_path().'/resources/images',
				'cache'=> storage_path().'/framework/cache/images'
		]);
		
		$this->server2 = ServerFactory::create([
				 
				'source'=> base_path().'/Wiki/resources/',
				'cache'=> storage_path().'/framework/cache/images'
		]);
		
    }
   
    public function outputImage($file, $instructions = null){
    	
    	$image = $this->server->outputImage($file, $instructions);
    	
    	return $image;
    	
    }
    
    public function wikiImage($file, $instructions = null){
    	 
    	$image = $this->server2->outputImage($file, $instructions);
    	 
    	return $image;
    	 
    }

    public function show(Filesystem $filesystem, $path, $disk = 's3', $instructions =[])
    {

        $disk = \Storage::disk($disk);
 
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $disk->getDriver(),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => '',
        ]);

        return $server->getImageResponse($path, $instructions);
    }
    
}

