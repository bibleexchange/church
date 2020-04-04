@extends('layouts.core')

@section('body')
<div id="be">
	<div id="fb-root"></div>
	
	@include('partials.main-nav')
      
	<div class="container-fluid wrapper">
		
		@yield('be_sub_banner')

        @if(session('message'))
        <div class="alert alert-info alert-dismissible fade show fixed-bottom col-sm-6" role="alert">
          <strong>{{ session('message') }}</strong> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
			
	<div class="push"></div>
</div><!-- ./end of wrapper & ./container-fluid-->

	@include('partials.main-footer')

		<!-- Javascript
		================================================== -->
		
		 @yield('scripts-first')
		
		<script type='text/javascript'>
			/* <![CDATA[ */
			var screenReaderText = {"expand":"<span class=\"screen-reader-text\">expand child menu<\/span>","collapse":"<span class=\"screen-reader-text\">collapse child menu<\/span>"};
			/* ]]> */
		</script>
			
        @yield('scripts')
</div>
@endsection
