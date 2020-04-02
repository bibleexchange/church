<?php namespace App;

use Illuminate\Database\Eloquent\Collection;
use App\User;
use DB;

class NotificationFetcher {
 
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
 
    /**
     * Constructor
     * 
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
 	
    private function group($notifications)
    {
        
    	$group = $notifications->select(
    			'notifications.body', 
    			'notifications.id',
    			'notifications.object_id',
    			'notifications.object_type',
    			DB::raw('max(notifications.sent_at) as sent_at'),
    			DB::raw('min(notifications.is_read) as is_read'),
    			DB::raw('count(distinct(notifications.sender_id)) as sender_count'),
    			DB::raw("case when count(DISTINCT(notifications.sender_id)) = 1 then users.firstname when count(DISTINCT(notifications.sender_id)) = 2 then GROUP_CONCAT(users.firstname SEPARATOR ' and ') when count(DISTINCT(notifications.sender_id)) > 2 then CONCAT(count(distinct(notifications.sender_id)), ' Members' ) end as sender_string"))
    			->join('users', 'users.id', '=', 'notifications.sender_id')
    			->groupBy('object_type', 'object_id');
  		return $group;
    }

    /**
     * Fetch the notifications
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function fetch($group=true)
    {
        //disabling notifications until i can solve related sql syntax errr
        //
        return collect([]);

        /*
        Illuminate\Database\QueryException
SQLSTATE[42000]: Syntax error or access violation: 1055 Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'exchange2.notifications.body' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by (SQL: select `notifications`.`body`, `notifications`.`id`, `notifications`.`object_id`, `notifications`.`object_type`, max(notifications.sent_at) as sent_at, min(notifications.is_read) as is_read, count(distinct(notifications.sender_id)) as sender_count, case when count(DISTINCT(notifications.sender_id)) = 1 then users.firstname when count(DISTINCT(notifications.sender_id)) = 2 then GROUP_CONCAT(users.firstname SEPARATOR ' and ') when count(DISTINCT(notifications.sender_id)) > 2 then CONCAT(count(distinct(notifications.sender_id)), ' Members' ) end as sender_string from `notifications` inner join `users` on `users`.`id` = `notifications`.`sender_id` where `user_id` = 1 and `is_read` != 1 group by `object_type`, `object_id` order by `is_read` asc, `sent_at` desc limit 20)
        */

    	$all_user_notifications = Notification::where('user_id','=',$this->user->id);
    	
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
