<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\UnfollowUserCommand;

use App\UserRepository;

class UnfollowUserCommandHandler {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param UserRepository $repository
     */
    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle(UnfollowUserCommand $command)
    {
        $user = $this->repository->findById($command->userId);

        $this->repository->unfollow($command->userIdToUnfollow, $user);
    }

}