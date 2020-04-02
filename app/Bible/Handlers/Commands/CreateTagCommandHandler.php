<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\CreateTagCommand;

use Illuminate\Queue\InteractsWithQueue;

use App\TagRepository;
use App\Tag;

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
	 * @param  Tag  $command
	 * @return void
	 */
public function handle(CreateTagCommand $command)
	{
		$tag = Tag::make(
				$command->name
		);

		$this->repository->save($tag);
		 
		//\Event::fire(new TagWasCreated($tag));

		return $tag;
	}

}