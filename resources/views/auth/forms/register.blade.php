<form action="{{ route('register') }}" method="post">
	@csrf
    <fieldset>
    	 <br>

      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label"><span class="input-group-addon" id="signin-email"><span class="fa fa-envelope" aria-hidden="true"> email</span></span></label>
        <div class="col-sm-10">
          <input type="text" name="email" id="email" value="{{old('email')}}"  class="form-control" required="required" aria-describedby="signin-email"/>

        </div>
      </div>

           
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label"><span class="input-group-addon" id="signin-password"><span class="fa fa-lock" aria-hidden="true"> password</span></span></label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="password" placeholder="Password" name="password" value=""  required="required" aria-describedby="signin-password">
        </div>
        {!! $errors->first('password', '<small style=\'color:red;\'>*:message</small>') !!}
      </div>

           
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label"><span class="input-group-addon" id="signin-password"><span class="fa fa-lock" aria-hidden="true"> password confirmation</span></span></label>
        <div class="col-sm-10">
          <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="Password" name="password" value=""  required="required" aria-describedby="signin-password">
        </div>
        {!! $errors->first('password_confirmation', '<small style=\'color:red;\'>*:message</small>') !!}
      </div>
        
         <br>
         
        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary">Create new account</button>
        </div>
    </fieldset>
</form>
