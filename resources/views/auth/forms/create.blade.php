 
 <?php 
 	if(! isset($redirect))
 	{
 		$redirect = null;
 	}
 ?>

 <form action="{{ route('login') }}" method="post">
	@csrf

	<input type="hidden" value={{$redirect}} name="redirect" />

      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label"><span class="input-group-addon" id="signin-email"><span class="fa fa-envelope" aria-hidden="true"> email</span></span></label>
        <div class="col-sm-10">
          <input type="text" name="email" value="" class="form-control" required="required" aria-describedby="signin-email"/>
        </div>
      </div>
	
	 <br>

     
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label"><span class="input-group-addon" id="signin-password"><span class="fa fa-lock" aria-hidden="true"> password</span></span></label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" value=""  required="required" aria-describedby="signin-password">
        </div>
      </div>
	
	 <br>

     <div class="form-group row">
        <div class="col-6">
	 	    <input type="checkbox" name="remember" value="true"/> remember me
        </div>
        <div class="col-6">
	 	    <input type="submit" value="Sign In" class='btn btn-success' />
        </div>
    </div>

      <div class="form-group row">
        <a href={!! url('/password/remind') !!}>reset your password</a>
		 </span>
    </div>
</form>
