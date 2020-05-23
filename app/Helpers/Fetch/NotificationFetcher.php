<?php namespace App\Helpers\Fetch;

use Illuminate\Database\Eloquent\Collection;
use App\UserNotification, App\User, DB;

class NotificationFetcher extends \App\Helpers\Fetch\Fetcher {
 
    public $id = 'notification';
    public $class = \App\UserNotification::class;

    /**
     * User we are fetching notifications for
     * 
     * @var User
     */
    protected $user;
 
    /**
     * Number of notifications to bring back
     * 
     * @var integer
     */
    protected $limit = 20;
 
    /**
     * Fetch only unread notifications
     * 
     * @var boolean
     */
    protected $unread = false;
 	
    private function group($notifications)
    {

    	$group = $notifications->select(
    			'user_notifications.body', 
    			'user_notifications.id',
    			'user_notifications.object_id',
    			'user_notifications.object_type',
    			DB::raw('max(user_notifications.sent_at) as sent_at'),
    			DB::raw('min(user_notifications.is_read) as is_read'),
    			DB::raw('count(distinct(user_notifications.sender_id)) as sender_count'),
    			DB::raw("case when count(DISTINCT(user_notifications.sender_id)) = 1 then users.nickname when count(DISTINCT(user_notifications.sender_id)) = 2 then GROUP_CONCAT(users.nickname SEPARATOR ' and ') when count(DISTINCT(user_notifications.sender_id)) > 2 then CONCAT(count(distinct(user_notifications.sender_id)), ' Members' ) end as sender_string"))
    			->join('users', 'users.id', '=', 'user_notifications.sender_id')
    			->groupBy('user_notifications.object_type', 'user_notifications.object_id', 'user_notifications.body', 'user_notifications.id');
               

  		return $group;
    }

    /**
     * Fetch the notifications
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function fetch($group=true)
    {

    	$all_user_notifications = UserNotification::where('user_id','=',$this->user->id);
    	
    	if($group === true)
    	{
    		$notificationsGroup = $this->group($all_user_notifications);
    	}else{
    		$notificationsGroup = $all_user_notifications;
    	}
    	
		$notifications = $notificationsGroup
			->orderBy('is_read', 'asc')
			->orderBy('sent_at', 'desc')
			->limit($this->limit);
 
        if($this->unread)
        {
        	$notifications->where('is_read', '!=', 1);
        }
  
        return $this->toCollection($notifications->get());
    }
 
    /**
     * Convert array to a Collection of Notification Models
     * @param  array $notifications
     * @return Illuminate\Database\Eloquent\Collection
     */
    private function toCollection($notifications)
    {
        if(empty($notifications)) return [];
 
        $notificationModels = [];
 
        foreach($notifications as $notification)
        {
            $notification->body = str_replace('{user}',$notification->sender_string, $notification->body);
        	
        	$notificationModels[] = $notification;
        }
 
        return new Collection($notificationModels);
    }
 
 
    /**
     * Chainable setter for the unread property
     * 
     * @param  int $limit
     * @return NotificationFether
     */
    public function onlyUnread()
    {
        $this->unread = true;
 
        return $this;
    }
 
    /**
     * Chainable setter for the limit property
     * 
     * @param  int $limit
     * @return NotificationFether
     */
    public function take($limit)
    {
        $this->limit = $limit;
 
        return $this;
    }
}
