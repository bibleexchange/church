<?php namespace App\Repository\Lrs;

interface Repository extends \App\Repository\Base\Repository {
    public function removeUser($id, $user_id);
    public function getLrsOwned($user_id);
    public function getLrsMember($user_id);
    public function changeRole($id, $user_id, $role);
}