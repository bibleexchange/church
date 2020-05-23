<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Auth;

class UpdateStudyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $study;
	public $namespace_id;
	public $text;
    public $user_id;
    public $comment;
    public $minor_edit;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($study, $inputArray)
    {
       	$this->study = $study;
		$this->input = $inputArray;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    ///need to break apart this update from when updating boxy and when just changing title etcs and handle these separtely.
       
        $text = request('text');

		if(request('translate_verses') >= 1){
			$text = Helper::convertReferences($text);
		}

		$comment = request('comment');
		$minor_edit = request('minor_edit');

        $text = \App\Text::create(["text"=>$text, "flags"=>'']);

        $length = strlen($text->text);

        $revision = \App\Revision::create([
            "study_id" => $this->study->id,
            "text_id" => $text->id,
            "comment" => $comment,
            "user_id" => Auth::user()->id,
            "minor_edit" =>  $minor_edit,
            "len" => $length
        ]);

        $this->study->namespace_id = 1;
        $this->study->user_id = Auth::user()->id;
        $this->study->latest_text_id = $text->id;
        $this->study->len = $length;
        $this->study->published_html = $text->text;
        $this->study->save();

    }
}
