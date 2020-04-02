<?php namespace App\Helpers;

use League\CommonMark\CommonMarkConverter as MD;
use League\CommonMark\Cursor;

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

	private function addTitles(){

		//$cursor = new Cursor($this->text);

		//dd($cursor->getLine());

		$dom_html = new \Htmldom($orig_html);
		$counter = 1;
		
		foreach($dom_html->find('h2') as $element) 
		{
			$search = '<h2>'.$element->innertext.'</h2>';
			$replace = '<h2 id="h2-'.$counter.'">'.$element->innertext.'</h2>';
			
			$orig_html = str_replace($search, $replace, $orig_html);
			
			$counter++;
		}

		return $orig_html;
	}

	public static function outline($text = false){

		$d = new static;

		if($text !== false){
			$d->text = $text;
		}

		//$cursor = new Cursor($d->text);

		//return $cursor->getLine();

		$x = explode("\n", $d->text);

		$s = '<ol style="list-style:none;">';

		$counter = 1;

		foreach($x AS $line){
			if(substr($line, 0,2) === "# "){
				$text = str_replace("# ", "", $line);
				$s .= '<li>' .$text . '</li>';
			}else if(substr($line, 0,3) === "## "){
				$text = str_replace("## ", "", $line);
				$s .= '<li><a href="#h2-'.$counter.'">' .$text . '</a></li>';
				$counter++;
			}else if(substr($line, 0,4) === "### "){
				$text = str_replace("### ", "", $line);
				$s .= '<li>' .$text . '</li>';
			}
			
		}
		
		$s .= '</ol>';

		$d->text = $s;

		return $d->text;
	}
}