<?php 
  		//this is a temporary hack for solving the following problem:
  		//in the event the user has an error registering
  		//default behavior is the user is return to this page
  		//but with the 'LOGIN" tab active instead of the 
  		//registration tab
  			
	if(count($errors) > 0 ){
  		$activeRegister = 'active';
  		$activeSignIn = '';
	}else{
      	$activeRegister = '';
  		$activeSignIn = 'active';
    }
  			
?>

@extends('studies.common')

@section('window')

    <div id="sub_be_banner" class="redBG">
		Your place for Bible study and conversation.
  	</div>

  	<div id="theme-squares">
		<div class="be-logo square"></div>
		<div class="moses square"></div>
		<div class="apostles square"></div>
		<div class="paul square"></div>
		<div class="creation square"></div>		
		<div class="moses square"></div>
	</div>

	<form id='go-to-study' action="{{ route('go_to_study', '') }}" style="display:inline-block" method="post"  role="search">
		@csrf
		<input type="text" value="" name="query" id="query" placeholder=""  />
		<input type="submit" value="study it!" class="btn btn-warning" />
	</form>
	


		  <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h2>Courses</h2>
                </div>
            </div>


                    <!-- partials.course-carousel -->
			        @include('partials.courses-carousel')


            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h2>Studies</h2>
                </div>
            </div>

              <div class="row justify-content-center">
                <div class="col-9">
			        @include('studies.partials.studies-index')
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-8 text-center">
			        {!! $studies->render() !!}
                </div>
            </div>

		</div>


    <div class="row justify-content-center">
		<div class="col-sm-4 col-sm-offset-2">
			<h3>With Bible exchange, you can:</h3>
			<ul>
			     <li>Discover sermons, lessons, poems, images, and stories that relate to the Scripture</li>
			     <li>Make notes on lessons and Bible verses</li>
			     <li>Ask questions and get answers about the Bible and lessons</li>
			     <li>See community notes from others</li>
			     <li>Save bookmarks</li>
			     <li>Follow instructors and see their lessons</li>
			</ul>
		</div>	
  		<div class="col-sm-4">
  			<ul class="nav nav-tabs">
			  <li role="presentation" class="{{$activeSignIn ?? 'active'}}"><a href="#sign-in" data-toggle="tab">Sign In</a></li>
			  <li role="presentation" class="{{$activeRegister ?? ''}}"><a href="#register" data-toggle="tab">Register</a></li>
			</ul>
  			
  			 <div id="my-tab-content" class="tab-content">
		        <div class="tab-pane {{$activeSignIn ?? 'active'}}" id="sign-in">
		        	<br>
		        	<!-- INCLUDE:  auth.forms.create -->
					@include('auth.forms.create')
		        </div>
		        <div class="tab-pane {{$activeRegister ?? ''}}" id="register">
		        	<br>
		        	<!-- INCLUDE:  auth.forms.register -->
					@include('auth.forms.register')
		        </div>
		    </div>

		</div>
	</div>	

           <div class="row justify-content-center">
                <div class="col-8 text-center">
			        <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; margin-top: 1rem; margin-bottom: 1rem;} .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>
			        <div class='embed-container'>
				        <iframe src='https://player.vimeo.com/video/120753625' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			        </div>
                </div>
            </div>

		<div class="row heading-box text-center" style="background-color:#FFB657;">
				<div class="col-md-12">
					<h2>Launched February 20, 2015</h2>
					<p>Journey with Us While We Grow</p>
					
					<p>
						<a href="https://twitter.com/bible_exchange">
							<span class="logo text-center fa fa-twitter" alt="follow us on Twitter"/>
						</a>
						<a href="https://www.facebook.com/thebibleexchange">
							<apn class="logo text-center fa fa-facebook" alt="like us on Facebook" />
						</a>
					</p>
				</div>	
		</div>	
 
		<div class="row heading-box text-center" style="background-color:rgb(0, 201, 137);">
			<div class="col-md-12">
				<h2>We Gain by Trading</h2>
			
				<div class="text-center">		
				
				<p>&hellip;when he was returned &hellip; he commanded these servants to be called unto him, &hellip; that he might know how much every man had gained by trading. &mdash; Luke 19:15</p>
				
				</div>
			</div>
		</div>

@stop
