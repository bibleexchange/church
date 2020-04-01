<form action="{{ route('highlight_verse') }}" class="form-inline" method="post" >
				@csrf	

	<input type="hidden" value="" name='bible_verse_id' />
	Highlight: 
	<div class="form-group">

	@foreach($highlight_colors AS $color)
		
		<input type="radio" value={{$color['id']}} name='color' id={$color['id']}/>

		<label for="{{$color['id']}}" class="bible-highlight" style="border-color:{{$color['strong']}}; background-color:{{$color['subtle']}};">
			{{$color['category']}}
		</label>
		
	@endforeach
	
	<input type="submit" value="Submit" class='btn btn-success' />

	</div>
</form>