<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="bibleExchange" itemscope itemtype="http://schema.org/Article">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-51587144-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-51587144-1');
    </script>

    @include('partials.meta')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/manifest.js') }}" defer></script>
    <script src="{{ asset('js/vendor.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans&subset=latin">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo&subset=latin">
		
	<link rel="apple-touch-icon" sizes="57x57" href="https://deliverance.me/images/be-apple-icon/be-apple-icon-57x57px.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="https://deliverance.me/images/be-apple-icon/be-apple-icon-72x72px.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="https://deliverance.me/images/be-apple-icon/be-apple-icon-114x114px.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="https://deliverance.me/images/be-apple-icon/be-apple-icon-144x144px.png" />

    @yield('style_links')
		
		<style>
		
			@yield('styles')
			@show
		
		</style>
		
		@yield('head')
</head>
<body>

    @yield('body')
    <!--<div id="example"></div>-->
</body>
</html>
