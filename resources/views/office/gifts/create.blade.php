@extends('layouts.office')

@section('office-content')
	
	
	<h2>
		<a href="/office/deposit/{{$offering->deposit->id}}#{{$offering->name}}"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a> 
		New Gift</h2>
	
	@include('office.partials.create_gift')	
	
@stop