@extends('layouts.app')

@section('content')
<div class="container">

         <div class="card">
                <h1 style="margin-bottom:15px;">Blog History</h1>
                <div class="contents">                
                </div>
        
        @foreach($posts AS $post)
            <div class="card" style="margin-bottom:30px;">
                <h2 style="margin-bottom:15px;"><a href={{url("/blog/".$post->id)}}>{{ $post->title }}</a></h2>
                <div class="contents">{{ count($post->tasks) }} Lessons</div>  
            </div>
        @endforeach

</div>
@endsection
