<?php namespace App\Http\Controllers\Bible;

use App\Bible\Requests\PublishNoteRequest;
use App\Bible\Commands\PublishNoteCommand;
use App\NoteRepository;
use Auth, Input, Flash, Redirect;

class NotesController extends Controller {

    /**
     * @var NoteRepository
     */
    protected $noteRepository;

    /**
     * @param PublishNoteForm $publishNoteForm
     * @param NoteRepository $noteRepository
     */
    function __construct(NoteRepository $noteRepository)
    {
    	$this->middleware('auth');
    	$this->noteRepository = $noteRepository;
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $notes = $this->noteRepository->getFeedForUser(Auth::user());
        $notes_per_page = 10;
		return view('notes.index', compact('notes','notes_per_page'));
	}
	
	public function data($limit = 8)
	{
		if(isset($_GET['count'])){
			$limit = $_GET['count'];
		}
		
		$jsonResponse =  $this->noteRepository->getFeedForUser(Auth::user(), $limit);
		
		return $jsonResponse;
	
	}
	
}
