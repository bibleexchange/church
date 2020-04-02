<?php namespace App\Bible\Events;

use App\User;

class UserHasUpdatedProfile {

    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

} 