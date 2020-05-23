@extends('layouts.core')

@section('body')

    <div id="church">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container d-flex justify-content-center flex-row align-items-start">

             <section class="flex-fill">
                <p><span class="tagline">A Bible Preaching Church since 1967</span></p>
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
                            <li class="nav-item">
                                 <a class="nav-link" href="/home">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

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
				@include('partials.church_contact')

            </div>
            <main class="col-sm-9">
             @yield('content')
            </main>

          </div>
        </div>

         @include('partials.church_footer')
    </div>

 

@endsection
