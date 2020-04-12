	@if(Request::is('user*'))
		<?php $editor = 'editor';?>
	@else
		<?php $editor = '';?>
	@endif
	
		<h1 class="{!!$editor!!}" id="{{$title}}">
			
		@if( isset($creating))<small>begin a study titled:</small><br><br> @endif
		{!! $title !!}
			<div class="center">
				<small><!--  subtitle --></small>
			</div>
		</h1>
	
		<div class="h1-underline"></div>
		<div class="h1-underline"></div>
		<div class="h1-underline"></div>
