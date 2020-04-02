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
    	
    	$image = $this->server->outputImage(img_base_url($file), $instructions);
    	
    	return $image;
    	
    }
    
    public function wikiImage($file, $instructions = null){
    	 
    	$image = $this->server2->outputImage(img_base_url($file), $instructions);
    	 
    	return $image;
    	 
    }

    public function show(Filesystem $filesystem, $path, $instructions =[])
    {
    /*
    $adapter = \Storage::disk('s3')->getDriver()->getAdapter();       

    $command = $adapter->getClient()->getCommand('GetObject', [
        'Bucket' => $adapter->getBucket(),
        'Key'    => $adapter->getPathPrefix().'church-doors.jpg'
    ]);

    $client = new \GuzzleHttp\Client();

    $request = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

    $response = $client->send($request, []);
    dd($response);
    */
        $disk = \Storage::disk('s3');
 
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

