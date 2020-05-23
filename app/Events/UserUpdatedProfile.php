<?php namespace App\Users\Profiles\Events;

use App\User;

class UserUpdatedProfile {

    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

} 