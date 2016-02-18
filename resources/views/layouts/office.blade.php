@extends('layouts.default')

@section('content-wide')

<div class="row windows">
	<div id ="sidebar" class="col-sm-4">
		@include('office.partials.nav')
	</div>

	<div class="col-sm-8">
		@yield('office-content')		
	</div>
</div>

@stop