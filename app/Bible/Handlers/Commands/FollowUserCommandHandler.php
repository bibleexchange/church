<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\FollowUserCommand;

use Illuminate\Queue\InteractsWithQueue;

use App\Bible\Entities\UserRepository;

class FollowUserCommandHandler {

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
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle(FollowUserCommand $command)
    {
        $user = $this->repository->findById($command->userId);

        $this->repository->follow($command->userIdToFollow, $user);

        return $user;
    }

}