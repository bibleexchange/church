@extends('courses.common')

@section('window')

<div class="row">

	<div class="col-md-4 sidebar">
		<div class="update-image">
			<img src="{!!$course->defaultImage->src!!}" alt="{!!$course->defaultImage->alt_text!!}">
            <hr>
            <a href="{!!$course->rssUrl()!!}" class="btn btn-info btn-md" >Atom RSS Feed</a>
		</div>
	</div>

	<div class="col-sm-8">

		<div class="container-fluid">

		    @foreach($course->sections AS $section)
			    <h2 style="margin-top:30px;" >Section {!! $section->orderBy!!}: {!! $section->title !!} ({!!$section->studies->count()!!})</h2>
                <hr>

				    <p>{!! $section->description !!}</p>

                    <div class="row justify-content-start">
					    @foreach($section->studies AS $study)
					
						    <!-- INCLUDE: studies.partials.study-preview -->
                            <div class="col-3">
						        @include('studies.partials.study-preview')
					        </div>
					    @endforeach
                    </div>
		    @endforeach

		</div>
	</div>
	
</div>

@stop
