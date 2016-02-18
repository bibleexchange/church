@extends('layouts.office')

@section('office-content')

<h1>Create a New Address</h1>

<ul>
	@foreach ($errors->all() AS $e)
	<li>{!! $e	!!}</li>
	@endforeach
</ul>
{!! Form::open(['url' => '/office/address']) !!}

	<div class="form-group">
        {!! Form::label('addressee', 'Addressee') !!}
        {!! Form::text('addressee', Input::old('addressee'), array('class' => 'form-control')) !!}
    </div>
	<div class="form-group">
        {!! Form::label('address', 'Address') !!}
        {!! Form::text('address', Input::old('address'), array('class' => 'form-control')) !!}
    </div>
	<div class="form-group">
        {!! Form::label('city', 'City') !!}
        {!! Form::text('city', Input::old('city'), array('class' => 'form-control')) !!}
    </div>
	<div class="form-group">
        {!! Form::label('state', 'State') !!}
        {!! Form::text('state', Input::old('state'), array('class' => 'form-control')) !!}
    </div>
	<div class="form-group">
        {!! Form::label('zip', 'Zip') !!}
        {!! Form::text('zip', Input::old('zip'), array('class' => 'form-control')) !!}
    </div>
	<div class="form-group">
        {!! Form::label('country', 'Country') !!}
        {!! Form::text('country', Input::old('country'), array('class' => 'form-control')) !!}
    </div>
	<div class="form-group">
        {!! Form::label('type', 'Type') !!}
        {!! Form::text('type', Input::old('type'), array('class' => 'form-control')) !!}
    </div>


    {!! Form::submit('Create Address!', array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}

@stop