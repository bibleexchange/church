@extends('layouts.office')

@section('office-content')

@if(isset($depositSums))

@include('office.partials.deposit_slip')
<div class="hidden-print">
<table>
<tr><th colspan='2'>Included Offerings</th></tr>
	<tr>
		<th>id</th>
		<th>name</th>
	</tr>
@foreach ($collectionOfferings AS $o)
<tr>
	<td>{{$o->id}}</td>
	<td>{{$o->name}}</td>
</tr>
@endforeach
</table>
</div>
@endif

@stop