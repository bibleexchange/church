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

<div class="container   windows">	
	<div class="row">
	
		<div class="col-md-11">
		
		<!--
		<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/110880921&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
		-->
		
		<style>
				.directions {
				  width:35px;
				  float:right;
				  height:35px;
				}
			
			</style>
		
			<h2 style="text-align:center;">
				<a href="https://www.google.com/maps/place/67+Hill+St,+Biddeford,+ME+04005/@43.4902852,-70.4550288,17z/data=!3m1!4b1!4m5!3m4!1s0x4cb2a455bd12cb21:0xf1aed6a50c51ac06!8m2!3d43.4902813!4d-70.4528401">67 Hill St, Biddeford, ME 04005				
				<img class="directions" alt="Embedded Image" src="data:image/png;base64,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" />
				</a></h2>
			
		</div>		
	</div>
</div>
<div class="container   windows">		
	<div class="row">
		<div class="col-md-6">
			<p>7pm, Friday  May 27</p>
			<p>2pm, Saturday May 28</p>
			<p>7 pm, Saturday May 28</p>
		</div>
		<div class="col-md-6">
			<p>10 am, Sunday May 29</p>
			<p>7pm, Sunday May 29</p>
			<p>2p, Monday May 30</p>
			<p>7p, Monday May 30</p>
		</div>
	</div>
</div>
<hr>
	<center>Contact Stephen: 207-774-8192</center>
<hr>
<div class="container   windows">		
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<a href="https://www.google.com/maps/place/67+Hill+St,+Biddeford,+ME+04005/@43.4902852,-70.4550288,17z/data=!3m1!4b1!4m5!3m4!1s0x4cb2a455bd12cb21:0xf1aed6a50c51ac06!8m2!3d43.4902813!4d-70.4528401">
			
				<img src="/images/victory-chapel.png" style="text-align:center; width:100%;"/>
			</a>
		</div>
	</div>
</div>
	
</div>

@stop