<?php namespace App\Handlers\Commands;

use App\Commands\UnamenObjectCommand;

use App\Helpers\UserRepository;

class UnamenObjectCommandHandler {

    /**
     * @param UserRepository $repository
     */
    function __construct(UserRepository $repository)
    {

    }

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle(UnamenObjectCommand $command)
    {
    	$command->user->unamen($command->amenable_type, $command->amenable_id);
    }

}