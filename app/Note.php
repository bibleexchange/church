<?php namespace App;

use App\Traits\PresentableTrait;
use App\Traits\AmenableTrait;
use App\Traits\CommentableTrait;
use Illuminate\Database\Eloquent\Model;
use \App\Traits\ManageTableTrait;

class Note extends Model implements \App\Interfaces\ModelInterface
{
	//protected $connection = 'mysql';
	
    use ManageTableTrait, PresentableTrait, AmenableTrait, CommentableTrait;

    /**
     * Fillable fields for a new note.
     *
     * @var array
     */
    protected $fillable = ['user_id','body','bible_verse_id','image_id'];
    
    protected $appends = ['tags'];
    
    /**
     * Path to the presenter for a note.
     *
     * @var string
     */
    protected $presenter = 'App\Presenters\NotePresenter';
	

 public function modifySchema($table){
      $table->id();
      $table->string('body');
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->unsignedBigInteger('bible_verse_id');
      $table->unsignedBigInteger('image_id');
      $table->timeStamps();
      return $table;
  }

    /**
     * A note belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
	
    public function isCreator($user){
    
    	if($this->user->id === $user->id){
    		return true;
    	}
    
    	return false;
    }
   
    public function verse()
    {
    	return $this->belongsTo('\App\BibleVerse','bible_verse_id');
    }
    
    public function url()
    {
    	return url('@' . $this->user->username . '/notes/' . $this->id);
    }
    
    public function editUrl()
    {
    	return null;
    }
    
    public function fbShareUrl()
    {
    	return url('@' . $this->user->username . '/notes/' . $this->id);
    }

    public function hint()
    {
    	return '"'.substr(strip_tags($this->body),0,64).'..." '.$this->verse->reference;
    }
    
    /**
     * Publish a new note.
     *
     * @param $body
     * @return static
     */
    public static function publish($bible_verse_id, $body, $image_id)
    {
    	$body = strip_tags($body);
    	
        $note = new static(compact('bible_verse_id','body','image_id'));

        return $note;
    }
 
    public function image()
    {
    	return $this->belongsTo('\App\Image');
    }
    
    public function defaultImageUrl()
    { 
    	
    	if($this->image === null){
    		
    		return '/images/be_logo.png';
    	}
    	
    	return url($this->image->src);
    	
    }
    
    public function getTagsAttribute()
    {
    	$array = explode('#',$this->body);
    	unset($array[0]);
    	$tags = implode(',',$array);
    	
    	return $tags;
    }
}