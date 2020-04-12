@extends('courses.common')

@section('window')

<div class="textbook" >
	
	@include('partials.courses-list',['courses'=>$courses])

	<center>{!! $courses->render() !!}</center>
	
</div>

@stop
