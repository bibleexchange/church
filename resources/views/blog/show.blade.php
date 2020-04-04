@extends('layouts.app')

@section('content')

<div class="container">
    <p><a href={{url("/blog")}}><i class="fa fa-angle-double-left"></i> Courses</a> | <a href={{url("/blog/".$course->id)}}><i class="fa fa-angle-double-left"></i> {{$course->title}}</a></p>
    <div class="card">
        
        <h2 tyle="margin-bottom:15px;">{{ $lesson->value->text->meta->title }}</h2>

        <ul>
        <h2 id="outline" >Outline: </h2>
            @foreach($lesson->value->text->meta->outline AS $o)
                <li class={{"outline-level-" . $o[2]}}><a href={{"#".$o[0]}}>{{$o[1]}}</a></li>          
            @endforeach
        </ul>

        <div class="contents">{!! $lesson->value->text->text !!}</div>  
    </div>

    <a href="#outline" class="float">
        <i class="fa fa-angle-double-up fa-3x my-float"></i>
    </a>

</div>
@endsection
