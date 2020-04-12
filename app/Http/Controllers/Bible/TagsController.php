<?php namespace App\Http\Controllers\Bible;

use App\Tag;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Bible\Helpers\Helpers as Helper;
use Flash, Input, Redirect;

class TagsController extends Controller {

	public function update()
	{
		$tagsArray = explode(',',request('tags'));
		$tags = Tag::pluck('name');
		
		$object_class_name = request('object_class');
		$object = $object_class_name::find(request('object_id'));
		$object->tags()->detach();
		
		foreach($tagsArray As $tag){
			
			$tag = trim($tag);
			
			if ( ! in_array($tag, $tags)){
				$tag = Tag::create(['name'=>$tag]);
				$tag->save();			
			}else{
				
				$tag = Tag::where('name',$tag)->first();
			}
			
			$object->tags()->attach($tag);
			
		}
		
		request()->session('message','Tagged Successfully!');
		
		return Redirect::back();
	}

}
