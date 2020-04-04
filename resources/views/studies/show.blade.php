@extends('studies.common')
	
@section('window')

        <!-- Content -->
		@include('studies.special-view-extended-2')
		<!-- ./ content -->	
	
	
		
	<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-51587144-2', 'auto');
	  ga('send', 'pageview');
	</script>

	<!--  INCLUDE: studies.partials.study-editor-js -->
	@include('studies.partials.study-editor-js')

@endsection
