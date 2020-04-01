<form action="{{ route('register') }}" method="post">
	@csrf
    <fieldset>
    	 <br>
		  <div class="input-group">
		 	<span class="input-group-addon" id="email"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> email (confirmation req.)</span>

		 	<input type="text" name="email" value={{old('email')}} class="form-control" required="required" aria-describedby="signin-email"/>

			{!! $errors->first('email', '<small style=\'color:red;\'>*:message</small>') !!}
		 </div>
		 
    	 <br>
 
		<div class="input-group">
		 	<span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock" aria-hidden="true"> password</span></span>
		 	
		 	<input type="password" name="password" value={{old('password')}} class="form-control" required="required" aria-describedby="signin-password"/>
		 	{!! $errors->first('password', '<small style=\'color:red;\'>*:message</small>') !!}
		 </div>
	 
    	 <br>
		<div class="input-group">
		 	<span class="input-group-addon" id="password_confirmation"><span class="glyphicon glyphicon-lock" aria-hidden="true"> password confirmation</span></span>
		 	
		 	<input type="password" name="password_confirmation" value={{old('password_confirmation')}} class="form-control" required="required" aria-describedby="signin-password-confirmation"/>
		 	{!! $errors->first('password_confirmation', '<small style=\'color:red;\'>*:message</small>') !!}
		 </div>
        
         <br>
         
        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary">Create new account</button>
        </div>
    </fieldset>
</form>
