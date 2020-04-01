<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\UpdateBEStudyCommand;

use Illuminate\Queue\InteractsWithQueue;

use App\Bible\Events\StudyWasCreated;
use App\Bible\Entities\StudyRepository;
use App\Bible\Entities\Revision;
use App\Bible\Entities\Study;
use App\Bible\Entities\Text;

class UpdateBEStudyCommandHandler {

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param UserRepository $repository
     */
    function __construct(StudyRepository $study)
    {
        $this->repository = $study;
    }

	/**
	 * Handle the command.
	 *
	 * @param  CreateLessonCommand  $command
	 * @return void
	 */
	public function handle(UpdateBEStudyCommand $command)
	{
				
		$text = Text::make($command->text);
		$text->save();
		
		$study = $command->study;
		$study->latest_text_id = $text->id;
		$study->is_published = 0;
    	$this->repository->save($study);
        
        $revision = Revision::make(	$study->id, 
        							$text->id, 
        							$command->comment, 
        							$command->user_id, 
        							$command->minor_edit, 
        							str_word_count(strip_tags($command->text)
        							));
        $revision->save();

        return $study;
	}

}