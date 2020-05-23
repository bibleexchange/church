<?php namespace App\Helpers;

use Config, File, Response, Flash, Redirect, Session, Storage;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class Image {

	 public function __construct(Request $request, $path = null){

	 	$this->path = $path;
	 	$this->request = $request;	

        $this->server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => Storage::disk('s3')->getDriver(),
            'source_path_prefix' => '',
            'cache' => Storage::disk('local')->getDriver(),
            'cache_path_prefix'     => '.cache',
            'base_url' => 'images/',
        ]);

        $this->server2 = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => Storage::disk('public')->getDriver(),
            'source_path_prefix' => '',
            'cache' => Storage::disk('local')->getDriver(),
            'cache_path_prefix'     => '.cache',
            'base_url' => 'images/',
        ]);
    }

    public function show(){

    	if(strpos($this->path, 'profile_image') !== false){
    		return $this->server2->getImageResponse($this->path, $this->request->all());
    	}
    	return $this->server->getImageResponse($this->path, $this->request->all());
    }

    public function defaultImage(){
    	return $this->server->getImageResponse('be_logo.png', $this->request->all());
    }

    public function showWiki($file, $instructions = null){
    	return $this->server2->outputImage($file, $instructions);
    }

    public static function copyImageToSession(\Request $request){
		
		if($request->has('study_id')){
			$study = Study::find(request('study_id'));
			$study->image_id = request('image_id');
			$study->save();
            $request->session()->flash('message', 'Image updated.');
			return Redirect::to($study->editUrl());
			
		}else if($request->has('course_id')){
			$course = Course::find(request('course_id'));
			$course->image_id = request('image_id');
			$course->save();
			$request->session()->flash('message', 'Image updated.');
			return Redirect::to($course->editUrl());
		}
		
            $request->session()->flash('error', 'Something went wrong!');
			
			return Redirect::back();
		
	}

	    public function svg(Filesystem $filesystem, $src1, $src2 = null, $src3 = null, $src4 = null)
	    {
            $file = $src1;
            if($src2 !== null){$file .= '/'.$src2;}
            if($src3 !== null){$file .= '/'.$src3;}
            if($src4 !== null){$file .= '/'.$src4;}

            $file = resource_path() ."/svg/". $file;

		    $image = file_get_contents( $file); //$this->imagePresenter->show($filesystem, $file, 'local', $_GET);
            
		    return $image;

	    }

}
