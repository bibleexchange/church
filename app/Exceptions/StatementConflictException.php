<?php namespace App\Exceptions;

use App\Exceptions\MonException;

class StatementConflictException extends  MonException
{
    public function __construct()
    {
        $message = $this->create(func_get_args());
        parent::__construct($message);
    }
}