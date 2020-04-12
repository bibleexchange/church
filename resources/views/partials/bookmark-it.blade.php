{!! Form::open(['url'=>'/user/bookmarks','style'=>'display:inline-block;']) !!}
	<input type="hidden" name="url" value="{!! Request::url() !!}">
	<button type="submit" value="Next"class="btn btn-primary" style="border:none; background:transparent;">
		<span class="fa fa-bookmark"></span>
	</button>
{!! Form::close()!!}