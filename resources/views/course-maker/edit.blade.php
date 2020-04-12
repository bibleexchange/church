@extends('course-maker.common')

@section('window')

<div class="row">

	<div class="col-md-4 sidebar">
		
		<div class="update-image">
			<img src="{!!$course->defaultImage->src!!}" alt="{!!$course->defaultImage->alt_text!!}">
			<button type="button" class="btn btn-primary btn-xs update-icon" data-toggle="modal" data-target="#updateImageModal">
			<span class="fa fa-edit" aria-hidden="true"></span> <span class="text">update</span>
			</button>

            			@include('course-maker.forms.edit')
			@include('course-maker.forms.public-private-course')
			@include('course-maker.forms.modal-create-section')
		</div>
			

			
	</div>

	<div class="col-sm-8">

		<hr>
		<ul>
		@foreach($course->sections AS $section)
			<li>
				<a data-toggle="collapse" data-target="#collapse{!!$section->id!!}" href="#collapseOne"> 				
					<h2>Section {!! $section->orderBy!!}: {!! $section->title !!} ({!!$section->studies->count()!!})</h2>
					<span class="caret pull-right"></span>
				</a>
				
				<span id="collapse{!!$section->id!!}" class="collapse">
					@include('course-maker.forms.edit-section')
				</span>	

                <div class="container-fluid">
				    <div class="row">
					    @foreach($section->studies AS $study)
					    <div class="col-md-4">
						    @include('studies.partials.study-preview')
					    </div>
					    @endforeach
				    </div>
                </div>
				
				@include('course-maker.forms.attach-study',['section'=>$section])
				
			</li>
		@endforeach
		</ol>
	</div>
	
</div>

<!-- Modals -->
@include('course-maker.forms.modal-update-image')

@stop
