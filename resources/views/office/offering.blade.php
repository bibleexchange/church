@extends('layouts.office')

@section('office-content')

 {{ Form::open(array('url'=>'office/offering', 'class'=>'well form-inline','role'=>'form','id'=>'gifts')) }}
<h2>Offering</h2>
<div class="form-group">
{{ Form::label('DepositsID','Deposit') }}
{{ Form::select('DepositsID', $allDeposits) }}
</div>
<div class="form-group">

	{{ Form::label('OfferingName','Offering Name') }}
	{{ Form::text('OfferingName', NULL, array('class'=>'', 'placeholder'=>'20140406A')) }}
	
</div>
<div class="form-group">
	{{ Form::label('OfferingMemo','Memo') }}
	{{ Form::text('OfferingMemo', NULL, array('class'=>'', 'placeholder'=>'memo')) }}
</div>

{{ Form::submit('NEW Offering', array('class'=>'btn'))}}

{{ Form::close() }}	

<h1>Most Recent Offerings:</h1>

@include('parts.barchart')

@stop