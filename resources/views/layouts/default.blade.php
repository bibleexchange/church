<html lang="en">
    <head>
		<title>Deliverance Center</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
          <meta name="description" content="">

 		<!--== Google Fonts ==-->
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Belgrano" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.2/united/bootstrap.min.css">
		<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.3/css/select2.min.css" rel="stylesheet" />
		<link href="/assets/all.css" rel="stylesheet" type="text/css"  media="screen">
		<link href="/assets/print.css" rel="stylesheet" type="text/css"  media=print>
		
	</head>
	<body>

		<header id="home">
			<div id="menu" class="main-navigation header-menu fixed">
				<div class="container"> <!--add class .block to add background color-->
					<div class="row">
						<nav role="navigation" class="col-sm-12">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>

								<!--== Logo ==-->
								<span class="navbar-brand logo white">
								    @if (! Request::is('/'))
								    <img src="/images/dc-dove.png" id="logo">
								     @endif
								</span>

							</div>
							<div id="navbar" class="navbar-collapse collapse pull-right">
								<!--== Navigation Menu ==-->
                                <ul class="nav navbar-nav">
                                    <li class="@if (Request::is('/') ? 'active' : '') @endif"><a href="/">Home</a></li>
                                    <li class="@if (Request::is('/live*') ? 'active' : '') @endif"><a href="/live">Live</a></li>
                                    <li class="@if (Request::is('/archives*') ? 'active' : '') @endif"><a href="/archives">Archives</a></li>
									<li class="@if (Request::is('/spring-2015*') ? 'active' : '') @endif"><a href="/archives/spring-2015">Spring Convention 2015</a></li>
                                    <li class="@if (Request::is('/news*') ? 'active' : '') @endif"><a href="/news">Ministry News</a></li>
                                    <li><a href="http://bible.exchange" >Bible exchange</a></li>    
                                </ul>
                            </div>
						</nav>
					</div>
				</div>
			</div>
             @if (Request::is('/'))
			<!--== Site Description ==-->
			<div class="header-cta">
				<div class="container">
					<div class="row">
						<div class="blk col-sm-12" style="text-align:center;">
							<h1 style="font-size:32px;">Deliverance Center has been a Bible preaching church since 1967</h1>
						</div>
					</div>
				</div>
			</div>
             @endif	

                     @if (Request::is('/'))
                        <div class="header-bg">
                    		<center><img src="/images/dc_building.png" alt="church house" id="dc-building" draggable="false" ></center>
                        </div>
                        
                     @else		   
                        
                        <div class="header-bg" style="max-height:200px">
                        </div>
                        
                     @endif		
            
		</header>
		
		<div class="container-fluid box">
			@yield('content-wide')
		</div>
		
		<div class="content">
		    <div class="container box">
                <!-- Content -->
                <section id="layout-content">
                   @yield('content')
                </section>
			</div>
		</div>
		<footer id="footer">
                
                <div id="map-canvas"></div>
		        <!-- Footer -->
        <footer id="layout-footer">
            @include('partials.footer')
        </footer>
		 
		 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		 
		<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.3/js/select2.min.js"></script>
		 
		 <script>try{for(var lastpass_iter=0; lastpass_iter < document.forms.length; lastpass_iter++){ var lastpass_f = document.forms[lastpass_iter]; if(typeof(lastpass_f.lpsubmitorig2)=="undefined"){ lastpass_f.lpsubmitorig2 = lastpass_f.submit; lastpass_f.submit = function(){ var form=this; var customEvent = document.createEvent("Event"); customEvent.initEvent("lpCustomEvent", true, true); var d = document.getElementById("hiddenlpsubmitdiv"); if (d) {for(var i = 0; i < document.forms.length; i++){ if(document.forms[i]==form){ if (typeof(d.innerText) != 'undefined') { d.innerText=i; } else { d.textContent=i; } } } d.dispatchEvent(customEvent); }form.lpsubmitorig2(); } } }}catch(e){}</script>
		
		<!--Start of Zopim Live Chat Script-->
		<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
		$.src='//v2.zopim.com/?2nMTEqj7SKXalM4FGLK1HM1RULsUaa9f';z.t=+new Date;$.
		type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
		</script>
		<!--End of Zopim Live Chat Script-->
		
        @yield('scripts')

</body>
    
</html>