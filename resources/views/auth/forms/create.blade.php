 
 <?php 
 	if(! isset($redirect))
 	{
 		$redirect = null;
 	}
 ?>

 <form action="{{ route('login') }}" method="post">
	@csrf

	<input type="hidden" value={{$redirect}} name="redirect" />
	
	 <div class="input-group">
	 	<span class="input-group-addon" id="signin-email"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> email</span></span>
	 	<input type="text" name="email" value="" class="form-control" required="required" aria-describedby="signin-email"/>
	 </div>
	
	 <br>
	
	  <div class="input-group">
	 	<span class="input-group-addon" id="signin-password"><span class="glyphicon glyphicon-lock" aria-hidden="true"> password</span></span>
	 	<input type="password" name="password" value="" class="form-control" required="required" aria-describedby="signin-password"/>
	 </div>
	
	 <br>
	
	 <div class="input-group">
	 	<input type="submit" value="Sign In" class='btn btn-success' />
	 	<input type="checkbox" name="remember" value="true"/> remember me
		 
	</div>
	<span class="pull-right">
		 	 {!! url('/password/remind', 'reset your password') !!}
		 </span>
</form>
