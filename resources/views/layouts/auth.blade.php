@extends('layouts.default')

@section('content')
    <div id="app">
             
                 <div id="sub_be_banner" class="redBG">
		Your place for Bible study and conversation.
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
                     @yield('window')
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
