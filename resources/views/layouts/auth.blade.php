@extends('layouts.core')

@section('body')
    <div id="app">
                
                <div class="container d-flex justify-content-end flex-row align-items-start">

                    <div class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Church</a>
                    </div>

                    <div class="nav-item">
                        <a class="nav-link" href="{{ url('/bible') }}">Holy Bible</a>
                    </div>

                    <div class="nav-item">
                        <a class="nav-link" href="{{ url('/study') }}">Bible exchange</a>
                    </div>

                     @guest

                        @if (Route::is('register'))
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                        @else
                        <div class="nav-item">
                             <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>
                        @endif
                    @else
         
                    @endguest
                </div>


            <div class="container d-flex justify-content-center flex-row align-items-start">

                <section class="" >
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <style>#dc-logo{fill:red; width:100%;}</style>

                            <div class="brand-logo">@include('logo-svg')</div>

                    </a>
                </section>

                <section class="" 
                      <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="/images/be_logo_200.png"/>
                    </a>
                </section>
            </div>

            <div class="container d-flex d-block justify-content-center flex-row align-items-start">
                <section class="flex-fill">
                    <main>
                     @yield('content')
                    </main>
                </section>
            </div>
            <div style="margin-top:30px; clear:both"></div>
            <div class="container d-flex d-block justify-content-center flex-row align-items-start">
                <section>
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
                </section>
            </div>

    </div>

    <footer>
        <center>A Bible Preaching Church since 1967</center>
    </footer>
@endsection
