<div class=" card panel-study pub_{{$study->is_published}}">
  <img class="card-img-top" src="{{$study->defaultImage->src}}?h=600&w=600" alt="{{$study->defaultImage->alt_text}}">
  <div class="card-body">
    <h5 class="card-title">{{ $study->present()->title }}</h5>
    <p class="card-text">{{ $study->present()->description }}</p>

    @if($study->isPublic())
			<a href="{!!$study->url()!!}" class="btn btn-primary" role="button"><span class="fa fa-eye-open" aria-hidden="true"></span> Open</a>
			
			@else
			<a class="btn btn-xs btn-default"><span class="fa fa-eye-close" aria-hidden="true"></span></a>
			
			@endif
		
 		@if ($currentUser)
		
	  	 	{!! Form::open(['url'=>'/user/bookmarks']) !!}
				<input type="hidden" name="url" value="{!!url($study->url())!!}">
				<button type="submit" value="Next"class="btn btn-info" >
					<span class="fa fa-bookmark"></span> <span class="hidden-md">Bookmark</span>
				</button>
			{!! Form::close()!!}
	  	 	 
	  	 	@if ($study->isCreator($currentUser))
				<a class="btn btn-warning" role="button" href="{!!$study->editUrl()!!}"><span class="fa fa-edit" aria-hidden="true"></span> <span class="hidden-xs hidden-md">Edit</span></a>
			@endif
		
		@endif

  </div>
    <div class="card-footer text-muted">
        @foreach($study->editors() As $editor)
			<a href="{{$editor->profileURL()}}" title="{!!$editor->fullname!!}">@include ('users.partials.avatar', ['size' => 25,'user'=>$editor])</a> 
		@endforeach

        <span class="updated"><span class="fa fa-time"></span> <!--Sept 16th, 2012-->{{ $study->present()->lastChangeWasMade }}</span>
  </div>
</div>
