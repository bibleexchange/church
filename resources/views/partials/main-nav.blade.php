<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <!-- BRAND -->
      <a class="navbar-brand" href="/" >
        <img src="/svg/be-logo.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        <span class="hidden-xs">Bible exchange<sup class="beta">beta</sup></span>
      </a>

       <!-- Left Nav Items -->

    <?php 	
	if(Request::is('admin*')){
		$adminState = 'active';
	}else if (Request::is('/','user*','/home')){
		$homeState = 'active';
		$userBannerColor = 'greenBG';
	}else if (Request::is('search/*')){
		$searchState = 'active';
	}else if (Request::is('kjv*','bible*') | isset($versePage)){
		$bibleState = 'active';
	}else {
		$exchangeState = 'active';
	}

	?>

    	@if (Auth::check() && Auth::user()->hasRole('admin'))

			<a href="{{ url('/admin') }}" class="nav-link admin {{$adminState ?? ''}}""><span class="fa fa-lock" aria-hidden="true"></span> Admin</a>

		@endif

        <a class="nav-link navbar-text home {{$homeState ?? ''}}" href="{{ url('/') }}"><span class="fa fa-home" aria-hidden="true" ></span> <span class="hidden-sm hidden-xs">Home</span></a>

        @if (Auth::check())						
			@if ($unReadNotifications->count() >= 1)
			<sup class="badge badge-warning">{{ $unReadNotifications->count() }}</sup>
			@endif
		@endif</a>

        <a class="nav-link navbar-text bible {{$bibleState ?? ''}}" href="{{ url('/bible') }}"><span class="fa fa-book" aria-hidden="true" ></span> <span class="hidden-sm hidden-xs">Holy Bible</span></a>

        <a class="nav-link navbar-text courses {{$exchangeState ?? ''}}" href="{{ url('/study') }}"><span class="fa fa-th-large" aria-hidden="true" ></span> <span class="hidden-sm hidden-xs">Exchange</span></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
       <li class="nav-item col-12 col-sm-12 col-md-12">
        @include('partials.search_form')
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/login">Login <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/register">Register</a>
      </li>
      
    </ul>

      
    </form>

  </div>
</nav>

<!--END NAVIGATION-->
