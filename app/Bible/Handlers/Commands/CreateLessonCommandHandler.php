<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\CreateLessonCommand;

use Illuminate\Queue\InteractsWithQueue;

use App\Bible\Events\LessonWasCreated;
use App\Bible\Entities\LessonRepository;
use App\Bible\Entities\Lesson;

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