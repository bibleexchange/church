<?php namespace App\Http\Controllers;

use App\Commands\UpdateProfileCommand;
use Auth,Input,Flash, Redirect, Evernote;
use App\User;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;

class UserSettingsController extends Controller {
	
	use UploadTrait;

	private $profileForm;
	
	public function index()
    {   
    	if(!Auth::user()->isSetup()){
    		return Redirect::to('/home');
    	}
    	return view('home.settings.index');
    }
	
	public function store(Request $request)
	{		
		$input = $request->all();

		$user = Auth::user();

		$user->update($request->only('name','nickname'));

		if (isset($input['profile_image'])){
			
			$image = $input['profile_image']->getRealPath();
			
			if($_SERVER['CONTENT_LENGTH'] >= 2022645){
				request()->session('error','file was too large');
				return Redirect::back();
			}
			
			 // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = 'profile_image_' . $user->id;
            // Define folder path
            $folder = '';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
            $user->save();
			
		}
		
		$request->session('message','Success! Your profile has been updated.');
		
		return Redirect::to('/home');
		
	}
	
	public function deleteProfileImage(){
		
		$user = Auth::user();
		$user->profile_image = null;
		$user->save();
		
		request()->session('message','Your profile image has been set to Gravatar.');
		
		return Redirect::to('/user/settings');
	}

	private function storeFile($file_path){

		if ($file->isValid()){
			

			$fileName = '/images/profiles/'. Auth::user()->id . '.' . str_replace('image/','',$imageMade->mime());
			$destination = base_path().'/resources'.$fileName;
			$imageMade->save($destination);
			
			$profile_image = $fileName;


			//Get Unique String
			$uuid = str_replace([' ','.'],'',microtime());
		
			//Place Image
			$destinationPath = public_path().'/images/uploads'; // upload path
			$extension = $file->getClientOriginalExtension(); // getting image extension
			$fileName = $uuid.'.'.$extension; // renaming image
			$file->move($destinationPath, $fileName); // uploading file to given path
		
			//Enter Image into Database
			$dbImage = new self;
			$dbImage->name = $uuid.'.'.$extension;
			$dbImage->src = url('/images/uploads/'.$fileName);
			$dbImage->alt_text = $model->present()->title;
			$dbImage->bible_verse_id = $model->mainVerse ? $model->mainVerse->id : null;
			$dbImage->user_id = $user->id;
			$dbImage->save();
		
			return $dbImage->id;
		}
		
		return false;
	}
}