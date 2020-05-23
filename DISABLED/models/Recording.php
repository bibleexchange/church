<?php namespace App;

use App\Traits\PresentableTrait;
use App\Bible\Core\CommentableTrait;
use App\Bible\Helpers\Helpers AS Helper;
use App\Image;

use DB;

class Recording extends \Eloquent {
	
	use CommentableTrait, PresentableTrait;
	
	
	
	protected $appends = ['defaultImage'];
	
	protected $fillable = [ 'dated','title' , 'description' , 'genre','created_at' , 'updated_at' ];
	
	protected $presenter = 'App\Bible\Presenters\RecordingPresenter';	
	
	public function studies()
	{
		return $this->belongsToMany('\App\Study', 'recording_study','recording_id','study_id');
	}
	
    public function formats()
    {
    	return $this->hasMany('\App\RecordingFormat');
    }
    
	public function featured()
    {
	   		return DB::table('spotlights')
            ->join('recordings', 'recordings.id', '=', 'spotlights.recordings_id')
			->join('contacts', 'contacts.id', '=', 'recordings.contacts_id')
            ->select('recordings.date','recordings.title','recordings.bible','contacts.firstname','contacts.lastname','contacts.id','contacts.image','spotlights.orderBy','contacts.suffix')
			->orderBy('spotlights.orderBy','ASC')
			->where('spotlights.active','>',0)
			->where('recordings.digital','>',0)
            ->get();
    }
	
    public static function scopeSearch($query,$search)
    {
    	return $query->where('title','LIKE','%'.$search.'%')
    	->orWhere('id','==','$search')
    	->orWhere('description','like','%'.$search.'%')
    	->orWhere('dated','like','%'.$search.'%')
    	->orderBy('title', 'ASC');
    }
    
	public function filter($search_field = NULL, $search_string = NULL)
    {
        if ($search_string == NULL || $search_field == NULL){
		return $this->orderBy('id','DESC')->paginate(15);  
		}else{
		return $this->where($search_field,'LIKE', '%'.$search_string.'%')->orderBy('id','DESC')->paginate(15);
		}
    }	
    
    public function getDefaultImageAttribute()
    {
    	return Image::find(1); 
    }
    
    public function url(){
    	
    	return url('/r/'.$this->id.'-'.Helper::userTitleToUrl($this->title));
    	
    }
    
    public function editUrl(){
  
    	return url('/recording/edit/'.$this->id);
    	 
    }
    
    public function shareUrl(){
    	 
    	return url('/r/'.$this->id);
    	 
    }
    
    public function scopeSoundcloud($query)
    {
    	return $query->whereHas('formats', function($q)
			{
			    $q->where('format', 'LIKE', 'soundcloud%');
			
			});
    }
    
    public static function scopeSearchTitle($query,$search)
    {
    	return $query->where('title','LIKE','%'.$search.'%');
    }
    
    public static function scopeSearchDated($query,$search)
    {
    	return $query->where('dated','LIKE','%'.$search.'%');
    }
    
    //Person
    public static function scopeSearchPerson($query,$search)
    {  		
    	$name = explode('-', $search);
    	
    	if(count($name) == 2)
    	{
    		$firstname = $name[0];
    		$lastname = $name[1];
    		
    		return $query->whereHas('persons', function ($query) use ($firstname, $lastname)
    		{
    			$query->where('firstname','LIKE','%'.$firstname.'%')->orWhere('lastname','LIKE','%'.$lastname.'%');
    		});
    		
    	}else if(count($name) == 1){
    		
    		return $query->whereHas('persons', function ($query) use ($name)
    		{
    			$query->where('firstname','LIKE','%'.$name.'%')->orWhere('lastname','LIKE','%'.$name.'%');
    		});
    		
    	}
    	
    }
    
    //Bible
    public static function scopeSearchBible($query,$search)
    {
    	
    	$id = BibleVerse::referenceTranslator($search);
    	
    	return $query->whereHas('verses', function ($query) use ($search)
    	{
    		$query->where('t_kjv.id', '=', $search);
    	});
    	
    }
    
    //Description
    public static function scopeSearchDescription($query,$search)
    {
    	return $query->where('description','LIKE','%'.$search.'%');
    }
    
    //Genre
    public static function scopeSearchGenre($query,$search)
    {
    	return $query->where('genre','LIKE','%'.$search.'%');
    }
    
    public static function searchForSimilar( $string ){
    
    	$ignore = ['a','able','about','above','across','after','again','against','ain\'t','all','almost','also','am','among','an','and','any','are','aren\'t','as','at','be','because','been','before','being','below','between','both','but','by','can','can\'t','cannot','could','could\'ve','couldn\'t','dear','did','didn\'t','do','does','doesn\'t','doing','don\'t','down','during','each','either','else','ever','every','few','for','from','further','get','got','had','hadn\'t','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','he\'s','her','here','here\'s','hers','herself','him','himself','his','how','how\'d','how\'ll','how\'s','however','i','i\'d','i\'ll','i\'m','i\'ve','if','in','into','is','isn\'t','it','it\'s','its','itself','just','least','let','let\'s','like','likely','may','me','might','might\'ve','mightn\'t','more','most','must','must\'ve','mustn\'t','my','myself','neither','no','nor','not','of','off','often','on','once','only','or','other','ought','our','ours','ourselves','out','over','own','rather','said','same','say','says','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','should\'ve','shouldn\'t','since','so','some','such','than','that','that\'ll','that\'s','the','their','theirs','them','themselves','then','there','there\'s','these','they','they\'d','they\'ll','they\'re','they\'ve','this','those','through','tis','to','too','twas','under','until','up','us','very','wants','was','wasn\'t','we','we\'d','we\'ll','we\'re','we\'ve','were','weren\'t','what','what\'d','what\'s','when','when\'d','when\'ll','when\'s','where','where\'d','where\'ll','where\'s','which','while','who','who\'d','who\'ll','who\'s','whom','why','why\'d','why\'ll','why\'s','will','with','won\'t','would','would\'ve','wouldn\'t','yet','you','you\'d','you\'ll','you\'re','you\'ve','your','yours','yourself','yourselves'];
    
    	$similarRecordings = [];
    	
    	$bibles = Recording::searchBible($string)->pluck('id');
    	$persons = Recording::searchPerson($string)->pluck('id');
    	
    	$titles = [];
    	$dates = [];
    	$descriptions = [];
    	$genre = [];
    	
    	$searchWords[] = explode("/",$string);
    
    	foreach(array_flatten($searchWords) AS $a){
    
    		$words[] = explode('-',$a);
    	}
    
    	$words = array_diff(array_flatten($words), $ignore);
    			
    		foreach( $words As $word )
    		{
    			$titles[] = Recording::searchTitle($word)->pluck('id');
    			$dates[] = Recording::searchDated($word)->pluck('id');
    			$descriptions[] = Recording::searchDescription($word)->pluck('id');
    			$genre[] = Recording::searchGenre($word)->pluck('id');
    		}
    
    	$similarRecordingsIds = array_merge(
    				array_flatten($titles),
    				array_flatten($dates),
	    			array_flatten($persons),
	    			array_flatten($bibles),
	    			array_flatten($descriptions),
	    			array_flatten($genre)
    			);
    
    	$ranks = array_count_values($similarRecordingsIds);
    
    	foreach($ranks AS $key => $value){
    
    		$similarRecordings[] = Recording::find($key);
    
    	}
    
    	return $similarRecordings;
    
    }
    
}