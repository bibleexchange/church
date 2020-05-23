<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Hash, Carbon\Carbon;
use App\Traits\FollowableTrait;

class User extends Authenticatable implements \App\Interfaces\ModelInterface, MustVerifyEmail
{
    use FollowableTrait, Notifiable, \App\Traits\ManageTableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'nickname', 'password','api_token',"profile_image"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      public function modifySchema($table){

      $table->id();
      $table->string('name')->nullable();
      $table->string('nickname')->nullable();
      $table->string('email');
      $table->string('password');
      $table->string('verified')->nullable();
      $table->string('profile_image')->nullable();
      $table->string('email_verified_at')->nullable();
      $table->string('remember_token', 1024)->nullable();
      $table->string('confirmation_code', 1024)->nullable();
      $table->string('api_token', 60)->unique()->nullable()->default(null);
      $table->timeStamps();

      return $table;

  }

  public function getSeed(){

      $seeds = [
        [
        "id"=>1,
        "name"=>"Deliverance Center",
        "email"=>"info@deliverance.me",
        "password"=>Hash::make('123'),
        "nickname"=>"dc",
        'api_token' => Str::random(60)
      ],
       [
        "id"=>2,
        "name"=>"Stephen Reynolds III",
        "email"=>"sgrj3r@deliverance.me",
        "password"=>Hash::make('123'),
        "nickname"=>"third",
        'api_token' => Str::random(60)
      ],
       [
        "id"=>8,
        "name"=>"stephengreynoldsjr",
        "email"=>"stephengreynoldsjr@gmail.com",
        "password"=>Hash::make('123'),
        "nickname"=>"stephengreynoldsjr",
        'api_token' => Str::random(60)
      ],
       [
        "id"=>9,
        "name"=>"Cheryl Lepage",
        "email"=>"cllepage61@gmail.com",
        "password"=>Hash::make('123'),
        "nickname"=>"cllepage61",
        'api_token' => Str::random(60)
      ],
       [
        "id"=>10,
        "name"=>"Matthew James Derocher",
        "email"=>"mjamesderocher@gmail.com",
        "password"=>Hash::make('123'),
        "nickname"=>"mjd",
        'api_token' => Str::random(60)
      ]
    ];

    return $seeds;

  }

    public function isSetup()
    {
    	if ($this->nickname !== null) return true;
    
    	return false;
    }
	
    public function isConfirmed()
    {
    	if ($this->email_verified_at !== null) return true;
    
    	return false;
    }

    public function isAdmin()
    {
      if ($this->email === \Config::get('auth')["admin_email"]) return true;
    
      return false;
    }

    public function gravatar($size = 44)
    {
        
    if ($this->profile_image !== NULL)
    {
      return "/images/". $this->profile_image.'?w='.$size;
    }
    
    $email = md5($this->email);

        return "//www.gravatar.com/avatar/{$email}?s={$size}&d=identicon";
    }

    /**
     * @return string
     */
    public function followerCount()
    {
        $count = $this->followers()->count();
        $plural = str_plural('Follower', $count);

        return "{$count} {$plural}";
    }

    /**
     * @return string
     */
    public function statusCount()
    {
        $count = $this->notes()->count();
        $plural = str_plural('Note', $count);

        return "{$count} {$plural}";
    }
    
    public function joined()
    {
        return Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
    }

    public function profileUrl(){
      return '/@'.$this->nickname;
    }

    public function amens(){
      return $this->hasMany('App\Amen');
    }

    public function notes(){
      return $this->hasMany('App\Note');
    }

    public function lessons(){
      return $this->hasMany('App\ClassroomSeriesCourseLesson');
    }

    public function courses(){
      return $this->hasMany('App\ClassroomSeriesCourse');
    }

    public function classrooms(){
      return $this->hasMany('App\Classroom');
    }

    public function bookmarks(){
      return $this->hasMany('App\Bookmark');
    }
   
    /**
     * Get a paginated list of all users.
     *
     * @param int $howMany
     * @return mixed
     */
    public static function getPaginated($howMany = 25)
    {
        return User::orderBy('username', 'asc')->whereNotNull('username')->paginate($howMany);
    }

    /**
     * Fetch a user by their username.
     *
     * @param $username
     * @return mixed
     */
    public static function findByUsername($username)
    {
      return static::with('notes')->where('nickname',$username)->first();
    }
    
    public static function findByEmail($email)
    {
      return static::whereEmail($email)->first();
    }
    
    /**
     * Find a user by their id.
     *
     * @param $id
     * @return mixed
     */
    public static function findById($id)
    {
        return static::findOrFail($id);
    }
    
    /**
     * Follow a App user.
     *
     * @param $userIdToFollow
     * @param User $user
     * @return mixed
     */
    public function follow($userIdToFollow)
    {
        return $this->followedUsers()->attach($userIdToFollow);
    }

    /**
     * Unfollow a App user.
     *
     * @param $userIdToUnfollow
     * @param User $user
     * @return mixed
     */
    public function unfollow($userIdToUnfollow)
    {
        return $this->followedUsers()->detach($userIdToUnfollow);
    }
}
