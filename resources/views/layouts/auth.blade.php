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
                    @include("partials.church_contact")
                </section>
            </div>
    </div>

    @include('partials.church_footer')
@endsection
