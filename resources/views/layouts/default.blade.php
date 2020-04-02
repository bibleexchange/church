<!DOCTYPE html>
<html lang="en" ng-app="bibleExchange" itemscope itemtype="http://schema.org/Article">
	<head>
		
		@include('partials.meta')
		
		<link rel="stylesheet" href="/assets/all.css">
		
		@yield('style_links')
		
		<style>
		
			@yield('styles')
			@show
			<!--Here you will find navbar governing behavior depending on whether a user is logged in or not -->
			<!-- INCLUDE:  partials.userConditionalCSS -->
			@include('partials.userConditionalCSS')
		
		</style>
		
		@yield('head')
		
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans&subset=latin">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo&subset=latin">
		
		<link rel="apple-touch-icon" sizes="57x57" href="http://bible.exchange/images/be-apple-icon/be-apple-icon-57x57px.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="http://bible.exchange/images/be-apple-icon/be-apple-icon-72x72px.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="http://bible.exchange/images/be-apple-icon/be-apple-icon-114x114px.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="http://bible.exchange/images/be-apple-icon/be-apple-icon-144x144px.png" />

	</head>

<body>	

	<div id="fb-root"></div>
	
	@include('partials.main-nav')
      
	<div class="container-fluid wrapper">

		<div id="mobile-search" class="hidden-lg hidden-md hidden-sm">
			@include('partials.search_form')
		</div>
		
		@yield('be_sub_banner')
			
			 <p class="alert alert-danger">{{ session('message') }}</p>	
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
			
	<div class="push"></div>
</div><!-- ./end of wrapper & ./container-fluid-->

	@include('partials.main-footer')

		<!-- Javascripts
		================================================== -->
		
		 @yield('scripts-first')
		
		<script type='text/javascript'>
			/* <![CDATA[ */
			var screenReaderText = {"expand":"<span class=\"screen-reader-text\">expand child menu<\/span>","collapse":"<span class=\"screen-reader-text\">collapse child menu<\/span>"};
			/* ]]> */
		</script>
	
		<script src="/assets/all.js"></script>
		
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		
		<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 		 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-51587144-2', 'auto');
		  ga('send', 'pageview');
		</script>
			
        @yield('scripts')
</body>
</html>
