<?php namespace App\Locker\data\dashboards;

class AdminDashboard extends BaseDashboard {

  private $user;

  public function __construct(){
    parent::__construct();
    $this->user = \Auth::user(); //we might want to pass user in, for example when use the API
  }

  /**
   * Set all stats array.
   *
   **/
  public function getFullStats(){
    $data = $this->getStats();
    return array_merge(
      $data,
      [
        'lrs_count'       => $this->lrsCount(),
        'user_count'      => $this->userCount(),
      ]
    );
  }

  /**
   * Count all LRSs in Learning Locker
   *
   * @return count
   *
   **/
  public function lrsCount(){
    return  \DB::table('lrs')->count();
  }

  /**
   * Count the number of users in Learning Locker.
   *
   * @return count.
   *
   **/
  public function userCount(){
    return \DB::table('users')->count();
  }

}
