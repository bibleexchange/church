@extends('layouts.app')

@section('content')
<div class="container">
    <p><a href={{url("/blog")}}><i class="fa fa-angle-double-left"></i> Courses</a></p>
         <div class="card">
                
                <h1 style="margin-bottom:15px;">{{$course->title}}</h1>
                <div class="contents">                
                </div>
        
        @foreach($course->tasks AS $lesson)
            <div class="card" style="margin-bottom:30px;">

                <div class="contents">
                <h2><a href={{url("/blog/".$course->id) . "/" . $lesson->id}}>{{ $lesson->title }}</a></h2></div>  
            </div>
        @endforeach

</div>
@endsection
