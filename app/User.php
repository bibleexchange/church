<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hash, Carbon\Carbon, Session;
use App\Traits\PresentableTrait;
use App\Traits\FollowableTrait;
use App\BibleChapter;

class User extends Authenticatable implements \App\Interfaces\ModelInterface 
{

  use PresentableTrait, FollowableTrait, Notifiable;
    /**
     * Which fields may be mass assigned?
     *
     * @var array
     */
    protected $fillable = ['firstname','middlename','lastname','suffix', 'username','twitter','profile_image','gender','email', 'password','confirmation_code', 'confirmed','active','email_verified_at'];
	
    public $adminTableHeaders = ['firstname','middlename','lastname','suffix', 'username','twitter','profile_image','gender','email', 'password','confirmation_code', 'confirmed','active'];
    
	protected $appends = array('fullname','url','recentChaptersRead');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    /**
     * Path to the presenter for a user.
     *
     * @var string
     */
    protected $presenter = 'App\Bible\Presenters\UserPresenter';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Passwords must always be hashed.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
    	return $this->attributes['password'] = Hash::make($password);
    }

    /**
     * A user has many notes.
     *
     * @return mixed
     */
    public function notes()
    {
        return $this->hasMany('\App\Note')->latest();
    }
    
    public function allowed($request)
    {
    	//create_be_study, create_be_recordings, 
    	//delete_be_recording_format
    	
    	if($this->hasRole('admin')) {
    		return true;
    	}
    	
    	return false;
    }
    
    public function coCourses()
    {
    	return $this->belongsToMany('\App\Course', 'course_user', 'user_id', 'course_id');
    }
    
	public function courses()
    {
    	return $this->hasMany('\App\Course');
    }
	
    public function studies(){
    	
    	return $this->hasMany('\App\Study','user_id')->orderBy('updated_at','DESC');
    }
    
    public function studiesNotUsedList($array = [null]){
    	return $this->studies()->whereNotIn ( 'id', $array )->get()->pluck('title','id');
    }
    
    public function answers(){
    	 
    	return $this->hasMany('\App\Answer','user_id');
    }
    
    public function highlights(){
    
    	return $this->hasMany('\App\BibleHighlight','user_id');
    }
    
    public function recentLessonEdited()
    {
    	return $this->lessons()->orderBy('updated_at','DESC')->first();
    }
    
	public function getrecentChaptersReadAttribute()
    {
		
		$array = [];
		
		if(Session::has('recent_bible_read'))
    	$array = Session::get('recent_bible_read');
		
		return $array;
    }
	
    public static function register($email, $password)
    {
        $confirmation_code = Hash::make($email);
    	
    	$user = new static(compact('email', 'password','confirmation_code'));

        return $user;
    }
	
    public static function confirm($confirmation_code)
    {
    	
    	$user = User::where('confirmation_code',$confirmation_code)->first();
    	
    	if($user !== null)
    	{
    		$user->confirmation_code = null;
    		$user->confirmed = 1;
    	}
    	
    	return $user;
    
    }
    
    public static function updateProfile($firstname,$middlename,$lastname,$suffix,$gender,$profile_image,$location)
    {

    	$user = \Auth::user();
    	
    	$user->username = strtolower($firstname).'-'.strtolower($middlename).'-'.strtolower($lastname).strtolower($suffix);
    	$user->firstname = $firstname;
    	$user->middlename = $middlename;
    	$user->lastname = $lastname;
    	$user->suffix = $suffix;
    	$user->gender = $gender; 

    	if($profile_image !== null){    		
    		$user->profile_image = $profile_image;
    	}
    	
    	$user->location = $location;
    	 
    	return $user;
    }
    
    /**
     * Determine if the given user is the same
     * as the current one.
     *
     * @param  $user
     * @return bool
     */
    public function is($user)
    {
        if (is_null($user)) return false;

        return $this->username == $user->username;
    }
    
    public function isSetup()
    {
    	if ($this->username !== null) return true;
    
    	return false;
    }
	
    public function isConfirmed()
    {
    	if ($this->confirmed > 0) return true;
    
    	return false;
    }
    
	public function roles()
    {
        return $this->belongsToMany('\App\Role');
    }
	
	public function hasRole($role)
    {
       If ($this->belongsToMany('\App\Role')->where('name','=',$role)->first()) return true;
	   
	   return false;
    }
	
    public function comments()
    {
        return $this->hasMany('\App\Comment');
    }
	
    public function bookmarks()
    {
    	return $this->hasMany('\App\Bookmark');
    }
    
	public function transcripts()
    {
        return $this->hasMany('Transcript','user_id');
    }
	
	public function joined()
    {
        return Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
    }
	
    public function profileURL()
    {
    	return url('/@'.$this->username);
    }
    
	public function profileImage()
    {
        return NULL;
    }
	
	public function getFullnameAttribute()
    {
        return $this->firstname.' '.$this->middlename.' '.$this->lastname.' '.$this->suffix;
    }
	
	 
	public function transcriptInfo()
    {
        $transcripts = \DB::table('transcripts')->where('user_id',$this->id);
		//careerGPA, careerCredits
		
		$a = new \stdClass();		
		$a->count = $transcripts->count();
		
		$a->careerGPA = $transcripts->avg('percentage') / 25;
		$a->careerGPA = round($a->careerGPA,2);

		$a->careerCredits =$transcripts->sum('credits_attempted');
		
		return $a;
		
    }
       
    public function passwordReset()
    {
    	$fromDate = \Carbon::now()->subDays(3);
    	$tillDate = \Carbon::now();

    	return $this->hasMany('\App\PasswordReset')
    		->whereBetween('created_at', [$fromDate, $tillDate])->first();
    }
    
    /*Notifications */
    
    public function notifications()
    {
    	return $this->hasMany('\App\Notification');
    }
    
    public function newNotification()
    {
    	$notification = new Notification;
    	$notification->user()->associate($this);
    
    	return $notification;
    }
    
    /* Amens */
    
    public function amens()
    {
    	return $this->hasMany('\App\Amen');
    }
  
    
    public function unamen($amenable_type, $amenable_id)
    {
    	
    	$this->amens()
    		->where("amenable_type", $amenable_type)
    		->where("amenable_id", $amenable_id)->delete();

    	return $this;
    }
    
    public function getUrlAttribute(){
    	return url('/@'.$this->username);
    }

    public function doSchema($table){
        $table->string('name');
        $table->string('username')->unique();
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->string('profile_image');
        $table->rememberToken();
        return $table;
    }
}
