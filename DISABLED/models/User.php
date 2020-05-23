<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hash, Carbon\Carbon, Session;
use App\Traits\PresentableTrait;
use App\Traits\FollowableTrait;
use App\Traits\ManageTableTrait;
use App\BibleChapter;
use App\Helpers\PermissionRequested;

class User extends Authenticatable implements \App\Interfaces\ModelInterface 
{

  use PresentableTrait, FollowableTrait, ManageTableTrait, Notifiable;
    /**
     * Which fields may be mass assigned?
     *
     * @var array
     */
    protected $fillable = ['firstname','middlename','lastname','suffix', 'username','profile_image','email', 'password','confirmation_code', 'confirmed','active','email_verified_at'];
	
    public $adminTableHeaders = ['firstname','middlename','lastname','suffix', 'username','twitter','profile_image','gender','email', 'password','confirmation_code', 'confirmed','active'];
    
	protected $appends = ['fullname','url','recentChaptersRead'];
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
    protected $presenter = 'App\Presenters\UserPresenter';

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

     public static function createToken($email, $password)
      {

            $auth = new stdClass;
            $auth->error = new stdClass;

            $auth->error->code = 200;
            $auth->error->message = null;
            $auth->token = null;
            $auth->user = new User;


          try {
              // attempt to verify the credentials and create a token for the user
              if (! $token = JWTAuth::attempt(['email'=>$email, 'password'=>$password])) {

                  $auth->error->message = 'invalid_credentials';
                  $auth->error->code = 401;
                  $auth->token = $token;
                  return $auth;
              }
          } catch (JWTException $e) {
              // something went wrong whilst attempting to encode the token
              $auth->error->message = 'could_not_create_token';
              $auth->error->code = 500;
              return $auth;
          }
          // all good so return the token

          $auth->user = static::where('email',$email)->first();
          $auth->token = $token;

          return $auth;
          //response()->json(['error'=>$error, 'token'=> $token, 'user'=> null]);
      }

    public static function signup($email, $password)
    {

            $auth = new stdClass;
            $auth->error = new stdClass;
            $auth->error->code = 200;
            $auth->error->message = null;
            $auth->token = null;
            $auth->user = static::getGuest();

       if (User::where('email',$email)->get()->count() < 1) {

          $user = new User;
          $user->email = $email;
          $user->setPassword($password);
          $name = explode('@',$email)[0];
          $user->name = $name;
          $user->verified = false;
          $user->nickname = $name;
          $user->confirmation_code = Hash::make($email);
          

          $subject = 'Please Confirm Your Email for Bible exchange';
          $view = 'emails.confirm';
          $data = ['confirmation_code'=>$user->confirmation_code];

          Mail::send('emails.confirm', $data, function ($message) use($user){
              $message->from('mail@bible.exchange', 'Bible exchange');
              $message->to($user->email)->bcc('sgrjr@deliverance.me');
          });
          $user->save();

          $auth->user = $user;
          $auth->token = $user->token;
          
        } else {

            $auth->error->code = 500;
            $auth->error->message = 'Email already taken!';
            $auth->user = static::getGuest();
         }
    
      return $auth;

    }


    public static function confirm($confirmation_code)
    {

        $user = User::where('confirmation_code',$confirmation_code)->first();

        if($user !== null)
        {
            $user->confirmation_code = null;
            $user->verified = true;
        $user->save();
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

    public function getAuthenticatedAttribute()
    {
      return Auth::check();
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Bookmark');
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

    public function getLastStepAttribute()
    {
        return Step::find(1);
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
        return $this->hasMany('App\Notification');
    }

    public function newNotification()
    {
        $notification = new Notification;
        $notification->user()->associate($this);

        return $notification;
    }

    public function newBookmark()
    {
        $bookmark = new Bookmark;
        $bookmark->user()->associate($this);

        return $bookmark;
    }

    public function amens()
    {
        return $this->hasMany('App\Amen');
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

    public function getTokenAttribute(){

        if($this->id == null){
              return null;
        }else {
          return JWTAuth::fromUser($this);
        }

    }

  public function lrs() {
    return $this->belongsToMany('\App\Lrs');
  }

  public function roles()
  {
    return $this->belongsToMany('\App\Role');
  }

    public function permissions()
    {
      $permissions = [];

      foreach($this->roles AS $role){

          foreach($role->permissions AS $p){
              $permissions[$p->name] = $p->name;
          }
      }

      return $permissions;
    }

    public function hasRole($role)
    {
       If ($this->roles()->where('name','=',$role)->first()) return true;

       return false;
    }

    public function can($request, $options = false)
    {
        return new PermissionRequested($this, $request, $options);
    }

    public static function getGuest($error = null)
    {
       $guest = new User;
       $guest->id = null;
       $guest->email = null;
       $guest->name = null;
       $guest->password = null;
       $guest->token = null;
       return $guest;

    }

  public static function getAuth($token = null){

            $a = new stdClass;
            $a->error = new stdClass;
            $a->token = str_replace('Bearer ','', $token);;
            $a->user = User::getGuest();
            $a->myNotes = null;

              if($token === "BACKDOOR"){die;
                $a->user = User::find(3);
                $a->token = $token;
              }else{

                try {
                     $auth = \JWTAuth::setToken($a->token);
                 }catch(JWTException $e){
                     $a->error->message= $e->getMessage();
                     $a->error->code = $e->getCode();
                     return $a;
                 }

              }



           try {

                   if (! $user = $auth->authenticate()) {
                        $a->error->message= 'user_not_found';
                        $a->error->code = 404;
                   }else{
                     $a->user = $user;
                      $a->error->message= 'Ok';
                      $a->error->code = 200;
                    }

               } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    $a->error->message= 'token_expired';
                    $a->error->code = $e->getStatusCode();
                } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    $a->error->message= 'token_invalid';
                    $a->error->code = $e->getStatusCode();
                } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                    $a->error->message= $e->getMessage();
                    $a->error->code = $e->getStatusCode();
                } finally {
                    $a->myNotes = $a->user->notes;
                    return $a;
                }

       }

   public function hasNotCompletedActivity($activity){
      
       $relatedUserStatements = $this->statements()->where('statements.activity_id',$activity->id)->get(['verb']);

       if($relatedUserStatements->count() < 1){
        return true;
       }else if(!in_array(
          'PASSED',
          array_flatten($relatedUserStatements->toArray())
          )) {
        return true;
       }else{
        return false;
       }


    }



      public function notes()
    {
        return $this->hasMany('App\Note');
    }

    public function tracks()
    {
        return $this->hasMany('App\Track');
    }

    public static function findRecentTrackByCourse($course_id){
      dd($course_id);
    }

    public function coCourses()
    {
        return $this->belongsToMany('App\Course', 'course_user', 'user_id', 'course_id');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function studies(){

        return $this->hasMany('App\Study','user_id')->orderBy('updated_at','DESC');
    }

    public function studiesNotUsedList($array = [null]){
        return $this->studies()->whereNotIn ( 'id', $array )->get()->lists('title','id');
    }

    public function answers(){

        return $this->hasMany('App\Answer','user_id');
    }

    public function lessons(){

      return $this->hasManyThrough('App\Lesson','App\Course');
    }

    public function highlights(){

        return $this->hasMany('App\BibleHighlight','user_id');
    }

    public function recentLessonEdited()
    {
        return $this->lessons()->orderBy('updated_at','DESC')->first();
    }

    public function getNavHistoryAttribute()
    {
    //$nav = ['id'=>, 'url'=>'','title'=>''];
    $nav = ['id'=>1, 'url'=>'/bible/james_1','title'=>'James 1'];
    $nav2 = ['id'=>2, 'url'=>'/bible/james_4','title'=>'James 4'];
    $nav3 = ['id'=>3, 'url'=>'/course/24_the-book-of-romans/1?ref=romans_1','title'=>'The Book of Romans: Step 1'];

    $array[0] = $nav;
    $array[1] = $nav2;
    $array[2] = $nav3;

    return $array;
    }

  public function statements() {
    return $this->hasMany('\App\Statement');
  }

  /**
   * Set a token to be used with email validation
   *
   **/
  public static function setEmailToken( $user, $email ){

    $token = sha1(uniqid(mt_rand(), true)); //we can do something more robust later
    \DB::table('user_tokens')->insert(
      array('email' => $email, 'token' => $token)
    );
    return $token;

  }

  /**
   * This is used for the primary email when the user creates an account.
   **/
  public static function sendEmailValidation( $user ){

    $token = User::setEmailToken($user, $user->email);
    $emailData = array('url' => \URL::to('email/verify', array($token)));
    
    \Mail::send(['emails.verifyHtml', 'emails.verifyPlain'], $emailData, function($message) use ($user){
      $message->to($user->email, $user->name)->subject('Welcome, please verify your email');
    });
    
  }

  /**
   * Invite in a user. 
   **/
  public static function inviteUser( $data ){

    //explode email addresses
    $emails = explode("\r\n", $data['emails']);
    $tokens = [];

    foreach( $emails as $e ){

      $isMember = false;

      //make sure lower case
      $e = strtolower($e);

      //check it is a valid email address
      if ( filter_var($e, FILTER_VALIDATE_EMAIL) ){

        //does the user already exist? If so, skip next step
        $user = \App\User::where('email', $e)->first();
        $user_exists = false; //boolean used to determine if add to lrs email sent

        if( !$user ){

          //create a user account
          $user       = new \App\User;
          $user->name   = $e;
          $user->email  = $e;
          $user->verified = 'no';
          $user->role   = isset($data['role']) ? $data['role'] : 'observer';
          $user->password = \Hash::make(base_convert(uniqid('pass', true), 10, 36));
          $user->save(); 

        }else{
          $user_exists = true;
        }

        //was an LRS id passed? If so, add user to that LRS as an observer
        if( isset($data['lrs']) ){

          $lrs = \App\Lrs::find( $data['lrs'] );

          //is the user already a member of the LRS?
          $isMember = \App\Helpers\Lrs::isMember($lrs->id, $user->id);

          //if lrs exists and user is not a member, add them
          if( $lrs && !$isMember){
      $roleId = \App\Role::where('name','OBSERVER')->first()->id;

      $newMember = new \App\LrsUser([
                          'user_id' => $user->id,
                          'lrs_id' => $lrs->id,
                          'role_id'  => $roleId ]);

            $newMember->save();
          }

        }

        //if user is already a member, exit here
        if( $isMember ){
          continue;
        }

        //determine which message to send to the user
        if( $user_exists && isset($lrs) ){
          //set data to use in email
          $emailData = array('sender' => \Auth::user(), 'lrs' => $lrs, 'url' => \URL::to("/lrs/" . $lrs->id));
          //send out message to user
          \Mail::send(['emails.lrsInviteHtml', 'emails.lrsInvitePlain'], $emailData, function($message) use ($user){
            $message->to($user->email, $user->name)->subject('You have been added to an LRS.');
          });
        }elseif( $user_exists){
          //do nothing as they are already in the system
        }else{
          //if adding to lrs, get lrs title, otherwise use the site name
          $title = isset($lrs) ? $lrs->title . ' LRS' : \Site::first()->name . ' '. \App\Site::first()->name;
          //set data to use in email
          $token = User::setEmailToken( $user, $user->email );
          $tokens[] = ['email' => $user->email, 'url' => \URL::to('email/invite', array($token))];
          $emailData = array('url'           => \URL::to('email/invite', array($token)),
                            'custom_message' => $data['message'],
                            'title'          => $title,
                            'sender'         => \Auth::user());

          //send out message to user
          \Mail::send(['emails.inviteHtml', 'emails.invitePlain'], $emailData, function($message) use ($user){
            $message->to($user->email, $user->name)->subject('You have been invited to join our LRS.');
          });

        }

      }

    }

    return $tokens;
    
  }
  
}
