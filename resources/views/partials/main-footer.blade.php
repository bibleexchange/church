<!-- Site footer -->

<footer class="container bottom">
  <div class="row">

    <div class="col-sm text-center">

        <h3><span class="fa fa-link"></span>  Navigation</h3>
		<p><a href="/">Home</a><br>
				<a href="/index">Courses</a><br>
				<a href="/members">Members</a><br>
			@if(!$currentUser)	
				<a href="/register">Register</a>
			@else
				
			@endif
		</p>

    </div>

    <div class="col-sm text-center">
        <h3><span class="fa fa-envelope"></span> Contact</h3>
	    <p><a href="mailto:info@deliverance.me?Subject=DBIonline" target="_top">info@deliverance.me</a></p>
		<p>1008 Congress Street Portland, Maine 04102</p>
    </div>

    <div class="col-sm text-center">
      	<h3><span class="fa fa-info-sign"></span> Information</h3>
		<!--<p><a href="/about" >About Us</a></p>-->
		<p><a href="//deliverance.me" >&copy; 2014 Deliverance Center</a></p>
		<!--<p><a href="#" >Policies</a></p>
		<p><a href="#" >Help</a></p>-->
    </div>

  </div>
</footer
