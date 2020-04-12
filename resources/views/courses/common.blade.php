@extends('layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row h1-box">
         @include('studies.partials.headline', ["title"=> $page->title ])
         </div>
    </div>

	@yield('window')

@stop
