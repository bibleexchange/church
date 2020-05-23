<?php namespace App\Repository\Client;

interface Repository extends \App\Repository\Base\Repository {
  public function showFromUserPass($username, $password, array $opts);
}