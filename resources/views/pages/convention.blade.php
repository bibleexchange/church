@extends('layouts.default')

@section('content')

<div class="container">	
	<div class="row">
	  <div class="col-sm-12">
		<div id="heading">

			<h1>{{ $page->title }}</h1>
			
			<p>For more recordings check us out on <a href="https://soundcloud.com/bible_exchange/sets/live-church-services">Sound Cloud</a> or <a href="http://mixlr.com/deliverance-center/showreel/">Mixlr</a>. </p>
			
		</div>
	  </div>
	</div>
</div>
<hr>

<style>
	.calendarBoxes {
		height: 200px;
		margin:0;
		 border:solid 1px #efefef;
		 text-align:center;
	}
	.calendarBoxes a {width:100%; height:100%; }
	
	@media screen{
		audio{
			width:98%; 
			display:block;
			position:absolute;
			bottom:0;
			margin-left:-13px;
		}
	}
	
	.unready {background-color:#efefef;}
	
	.unready a {display:none;}
	
</style>

<div class="container   windows">	
	<div class="row">
	
		<div class="col-md-11">
		
		<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/110880921&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
		
		<!--
		
			@foreach(array_chunk($mixlrs,3) AS $chunk)
				
				<div class="row">
					@foreach($chunk AS $m)
					
						<?php
							$notready = '';
							
							if($m->download === ""){
								$notready = 'unready';
							}
						?>
					
						<div class="col-md-3 calendarBoxes {{$notready}}">
							<a href="{{$m->link}}" >{{$m->date}} <br>"{{$m->title}}" <br>{{$m->preacher}}</a>	
							
							<audio controls>
							  <source src="{{$m->download}}" type="audio/mpeg">
							Your browser does not support the audio element.
							</audio>
							
						</div>
					@endforeach
				</div>
			
			@endforeach
			
			-->
			
		</div>
	</div>
</div>


@stop