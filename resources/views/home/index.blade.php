@extends('layouts.default')

{{-- Content --}}
@section('content')

	
	<div id="sub_be_banner" class="row greenBG" >

			<div class="col-xs-12" style="width:100%; text-align:center; padding:30px; font-size: 2rem;">
			
				@if($currentUser->isConfirmed())
					Let's Personalize Your Account
				@else
					Let's Confirm Your Email
				@endif
				

					<li style="font-size:1.25rem; list-style:none;">Member since: {{{$currentUser->joined()}}}</li>

			</div>

	</div>
<div class="container">
	<div class="row" >

			<div class="col-xs-12">
			
			@if($currentUser->isConfirmed())

				<h2>Hi! We are so glad to have you on Bible exchange.</h2>
				<p>First off, let's get to know a little more about you so we can personalize your account.</p>

				@include('home.partials.profile-form')
				
			@else
				<h1>&nbsp;</h1>
				<p>For a quality experience, we need to make sure you're a person :). Check your email for a link to confirm your address.</p>
		
				<p>If you can't find it, we can resend a confirmation by clicking below.</p>
				
				@include('auth.forms.request-confirmation-email')
			@endif
				
			</div>

	</div>
</div>
@stop