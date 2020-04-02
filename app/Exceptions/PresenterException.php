<?php

namespace App\Exceptions;

use Exception;

class PresenterException extends Exception
{
     /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::debug('Presenter protected property not set on Model.');
    }


}
