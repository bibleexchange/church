<?php namespace App;

use App\Traits\PresentableTrait;
use App\Bible\Core\AmenableTrait;
use App\Bible\Core\CommentableTrait;

class Note extends \Eloquent {
	
	//protected $connection = 'mysql';
	
    use PresentableTrait, AmenableTrait, CommentableTrait;

    /**
     * Fillable fields for a new note.
     *
     * @var array
     */
    protected $fillable = ['body','bible_verse_id','image_id'];
    
    protected $appends = array('tags');
    
    /**
     * Path to the presenter for a note.
     *
     * @var string
     */
    protected $presenter = 'App\Bible\Presenters\NotePresenter';
	
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