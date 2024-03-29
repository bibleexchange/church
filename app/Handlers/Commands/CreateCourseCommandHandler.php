<?php namespace App\Handlers\Commands;

use App\Commands\CreateCourseCommand;

use Illuminate\Queue\InteractsWithQueue;

use App\Events\CourseWasCreated;
use App\Course;

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