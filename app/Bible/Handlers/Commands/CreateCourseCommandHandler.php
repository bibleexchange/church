<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\CreateCourseCommand;

use Illuminate\Queue\InteractsWithQueue;

use App\Bible\Events\CourseWasCreated;
use App\Bible\Entities\Course;

class CreateCourseCommandHandler {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param UserRepository $repository
     */
    function __construct()
    {

    }

	/**
	 * Handle the command.
	 *
	 * @param  CreateLessonCommand  $command
	 * @return void
	 */
	public function handle(CreateCourseCommand $command)
	{
		
		$course = Course::make(
				$command->shortname,
				$command->slug,
				$command->subtitle,
           		$command->title
        );

    	$course->save();
    	
    	$command->user->courses()->attach($course->id);
    	
        \Event::fire(new CourseWasCreated($course, $command->user));
        
        return $course;
	}

}