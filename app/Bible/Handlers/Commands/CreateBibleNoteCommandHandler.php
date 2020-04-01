<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\CreateBibleNoteCommand;
use Illuminate\Queue\InteractsWithQueue;
use App\Bible\Entities\NoteRepository;
use App\Bible\Entities\Note;

class CreateBibleNoteCommandHandler {
	
	private $noteRepository;
	
	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(NoteRepository $noteRepository)
	{
		$this->noteRepository = $noteRepository;
	}

	/**
	 * Handle the command.
	 *
	 * @param  CreateBibleNoteCommand  $command
	 * @return void
	 */
	public function handle(CreateBibleNoteCommand $command)
	{		
		$note = Note::publish($command->bible_verse_id, $command->body, $command->image_id);
	
		$note = $this->noteRepository->save($note, $command->userId);
	
		return $note;
	}
}
