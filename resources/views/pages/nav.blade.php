<html lang="en">
    <head>
		<title>Deliverance Center</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Belgrano" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href="/assets/combine.css" rel="stylesheet" media="screen">
		<link href="/assets/all.css" rel="stylesheet" type="text/css">
	    		
		<style>
			
			@media(min-width:0){
				
				html {background-color:white;}
				html, body {width:100%; height:100px; margin-top:0;}
				.navbar-brand img {position:relative; margin-top:-50px}
				nav {
					height:auto;
				}
				#menu {margin-top:0}
				
				#home {min-height:100px;}
				
				.navbar-header button {display:none}
				#navbar {display:inline-block;}
				
				.nav li {display:inline-block;}
			
			}
			
		</style>
		
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
                                    <li class="@if (Request::is('/') ? 'active' : '') @endif"><a href="/" target="_parent">Home</a></li>
                                    <li class="@if (Request::is('/live*') ? 'active' : '') @endif"><a href="/live" target="_parent">Live</a></li>
                                    <li class="@if (Request::is('/archives*') ? 'active' : '') @endif"><a href="/archives" target="_parent">Archives</a></li>
                                    <li class="@if (Request::is('/news*') ? 'active' : '') @endif"><a href="http://blog.deliverance.me" target="_parent">Ministry News</a></li>
                                    <li><a href="http://bible.exchange" target="_parent">Bible exchange</a></li>    
                                </ul>
                            </div>
						</nav>
					</div>
				</div>
			</div>
		</header>
</body>
    
</html>