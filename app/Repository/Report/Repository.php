<?php namespace App\Repository\Report;

interface Repository extends \App\Repository\Base\Repository {
  public function setQuery($lrs, $query, $field, $wheres);
  public function statements($id, array $opts);
}