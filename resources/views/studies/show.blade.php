@extends('studies.common')
	
@section('window')

        <!-- Content -->
		<!-- The following ".site" is essential to the sidebar behavior -->

<div class="container-fluid">
    <div class="row h1-box">
     @include('studies.partials.headline',["title"=>$study->present()->Title])
     </div>
</div>

<div class="container-fluid">
	<div id="studies" class="row site justify-content-around">
		<div id="sidebar" class="col-md-4">
			<div class="sidebar">
				<div id="masthead" class="site-header" role="banner">
	
						@include('studies.partials.sidebar-main')
						
						<a id="secondary-toggle" data-toggle="collapse" href="#sidebar-collapse" aria-expanded="false" aria-controls="collapseExample" class="collapsed d-md-none">
							<div class="sidebar-block greenBG">
								<h2><span class="fa fa-chevron-down" aria-hidden="true"></h2>
							</div>
						</a>
						
				</div><!-- .site-header -->
	
				<div id="secondary" class="secondary">
					
					@include('studies.partials.sidebar-secondary')
					
				</div><!-- .secondary -->
			</div>
		</div><!-- .sidebar -->
		
		<div id="content" class="col-md-8 site-content">
			<!-- Main Content Goes Here like "TEXTBOOK"-->
			
				@if($study->exists && $bible)

		            <div>
			            @include('studies.partials.textbook')
		            </div>
		            <div id="bible-panel" style="width:30%; position:fixed; right:20px; bottom:0; ">
			            <div class="panel panel-default">
			              <div class="panel-heading">
				            <a href="#bible-text" data-toggle="collapse" data-parent="#bible-panel">
					            <h3 class="panel-title">Resources</h3>
				            </a>
			              </div>
			              <div id="bible-text" class="panel-body panel-collapse collapse in" style="max-height:500px; height:100%; overflow:scroll; overflow-x:hidden;">
				            @include('bible.chapter-min')
			              </div>
			            </div>
		            </div>
	
	            @elseif($study->exists && $bible === false)
	
		            @include('studies.partials.textbook')
		
	            @elseif($study->exists === false && $bible != false)
	
		            @include('bible.chapter-min')
	
	            @else
		
		            BLANK
	
	            @endif
			
		</div><!-- .site-content -->
		
	</div><!-- .row -->
	
</div><!-- .container-fluid -->

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

@section('scripts')
	<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript">
		@include('partials.jquery-selectable-test')
	</script>
@stop
