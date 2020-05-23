<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PresentableTrait;

class Bookmark extends Model implements \App\Interfaces\ModelInterface
{
    use \App\Traits\ManageTableTrait;
	
	protected $fillable = ['url','user_id','created_at','updated_at'];
	
	protected $presenter = 'App\Bible\Presenters\BookmarkPresenter';
	
	//returns this column as Carbon instances!
	public function getDates()
	{
		return ['created_at','updated_at'];
	}
	
	public function user()
    {
        return $this->belongsTo('User');
    }


	public function title(){
		return ucwords($this->entity->title);
	}
	
	public function created_at(){
		return $this->entity->created_at->format('M. d, Y h:m a');
	}
	
	public function updated_at(){
		return $this->entity->updated_at->format('M. d, Y h:m a');
	}
	
	public function content()
	{
		if(isset($this->entity->content)) {return nl2br($this->content);}
	
		return null;
	}
	/**
	 * Get the post's meta_description.
	 *
	 * @return string
	 */
	public function description()
	{
		
	if ($this->entity->description === NULL)
		{
			if ($this->entity->content_format === 'md'){

				$description =  Str::limit( preg_replace('/#/', ' ', $this->entity->content), 200);
			}else{
				$description =  Str::limit( preg_replace('/(<.*?>)|(&.*?;)/', '', $this->entity->content), 200);
			}
			
			$lesson = \App\Lesson::find($this->entity->id);
			$lesson->description = $description;
			$lesson->save();
			
		}
		
		return $this->entity->description;
		
	}

	public function keywords()
	{
		return $this->entity->keywords;
	}

	public function modifySchema($table){
	      $table->id();
	      $table->string('url');
	      $table->foreignId('user_id')->constrained()->onDelete('cascade');
	      $table->timeStamps();
	      return $table;
	  }
	
}