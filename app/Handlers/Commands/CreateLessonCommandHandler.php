<?php namespace App\Handlers\Commands;

use App\Commands\CreateLessonCommand;

use Illuminate\Queue\InteractsWithQueue;

use App\Events\LessonWasCreated;
use App\LessonRepository;
use App\Lesson;

class CreateLessonCommandHandler {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param UserRepository $repository
     */
    function __construct(LessonRepository $lesson)
    {
        $this->repository = $lesson;
    }

	/**
	 * Handle the command.
	 *
	 * @param  CreateLessonCommand  $command
	 * @return void
	 */
	public function handle(CreateLessonCommand $command)
	{
		$lesson = Lesson::make(
           		$command->title, 
				$command->user_id, 
				$command->slug, 
				$command->content
        );

    	$this->repository->save($lesson);
    	
        \Event::fire(new LessonWasCreated($lesson));
        
        return $lesson;
	}

}