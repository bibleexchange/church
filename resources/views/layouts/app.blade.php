@extends('layouts.core')

@section('body')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container d-flex justify-content-center flex-row align-items-start">

             <section class="flex-fill">
                <span class="tagline">A Bible Preaching Church since 1967</span>
            </section>

            <section class="flex-fill">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <style>#dc-logo{fill:red;}</style>

                        <div class="brand-logo">@include('logo-svg')</div>

                </a>
            </section>

            <section class="flex-fill">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Church</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/bible') }}">Holy Bible</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/study') }}">Be</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
                </section>
            </div>
        </nav>

        <div class="container">
          <div class="row">
            <div class="col-sm-3">
				<p>930 Old Post Rd Arundle, Maine 04046</p>
				<p>Call or Text: (207) 774-8192</p>

				<a>Links</h2>

				<ul>
					<a href="/">Home</a>
					<li><a href="/blog">Blog</a></li>
					<li><a href="http://mixlr.com/deliverance-center">Live Services Audio Stream</a></li>
					<li><a href="http://mixlr.com/deliverance-center/show-reel">Archive Service Recordings on Mixlr</a></li>
					<li><a href="https://www.facebook.com/pg/deliverancecenter">Facebook</a></li>
				</ul>


                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            				<input name="cmd" type="hidden" value="_s-xclick">
            				<input name="hosted_button_id" type="hidden" value="MNDYCC59PET5A">            				
            				
            				
            	</form>

                <h2>Live Stream</h2>
   
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/live_stream?channel=UC3M6eX6w0iZ6WcowSNokq2g" frameborder="0" allowfullscreen="" class="ui-droppable"></iframe>

				<h2>Regular Services</h2>

				<ul>
					<li>Sunday School 10 am</li>
					<li>Sunday Morning 11 am</li>
					<li>Sunday Night 4:30 pm</li>
					<li>Tuesday Bible Study & Prayer Meeting 6 pm</li>
				</ul>

				<button name="submit" class="btn btn-default circle">donate</button>

            </div>
            <main class="col-sm-9">
             @yield('content')
            </main>

          </div>
        </div>

    </div>

    <footer>
        <center>A Bible Preaching Church since 1967</center>
    </footer>
@endsection
