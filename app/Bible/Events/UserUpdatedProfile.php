<?php namespace App\Bible\Users\Profiles\Events;

use App\Bible\Entities\User;

class UserUpdatedProfile {

    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

} 