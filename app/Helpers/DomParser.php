<?php namespace App\Helpers;



class DomParser {

	public function __construct(String $text=null){
		$this->text = $text;
	}

	public static function parse($text = false){

		$that = new static;

		if($text !== false){
			$that->text = $text;
		}

		$text = $that
			//->addTitles()
			->parseMarkdown()
			//->addLineBreaks()
			;

		return $text->text;

	}

	private function parseMarkdown(){

		$converter = new MD([
		    'html_input' => 'strip',
		    'allow_unsafe_links' => false,
		]);

		$this->text = $converter->convertToHtml($this->text);

		return $this;
	}

	private function addLineBreaks(){
		//nl2br — Inserts HTML line breaks before all newlines in a string
		$this->text = nl2br($this->text);
		return $this;
	}

	
}
