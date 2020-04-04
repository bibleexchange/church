<?php
	/*(
	if(isset($bible) && $bible === true){
		$go_to_previous = '?bible='.$chapter->previousReference;
		$go_to_next = '?bible='.$chapter->nextReference;
		$search_here =  '#';
		dd(22);
	}else{
		$go_to_previous = $chapter->previousURL;
		$go_to_next = $chapter->nextURL;
		$search_here =  '#';
	}
	*/
?>

<form action="{{ url('/bible/search') }}" style="display:inline-block" method="post"  role="search">
	@csrf	

	
	<button type="submit" class="btn btn-default" style="border:none; background:transparent;">
		<span class="fa fa-search">
			<span class="sr-only">Search...</span>
		</span>
	</button>

	<input type="hidden" value="putt a url here" name="redirect" />

	<input type="text" value="" name="search" id="reference" placeholder={{$currentReference}} style="height:100%; margin:0; border:1.11px; padding:4.5px; display:inline-block; vertical-align:middle;background:transparent; text-align:center;max-width:150px; background:rgba(255,255,255,.1)" />

</form>