/**
* Inspired by WordPress's Twentyfifteen theme
 */ 
( function( $ ) {
	var $body, $window, $sidebar, adminbarOffset, top = false,
	    bottom = false, windowWidth, windowHeight, lastWindowPos = 0,
	    topOffset = 0, bodyHeight, sidebarHeight, resizeTimer,
		secondary, fixerColumn;

	secondary = $( '#secondary' );
	main = $( '#content').first();
	
	// Sidebar scrolling.
	function sideScroll() {
		var windowPos = $window.scrollTop();
		
		if ( $( window ).width() < 992) {
			$sidebar.attr('style', 'position: relative; top:0;' );
			return;
		}
		
		sidebarHeight = $sidebar.height();
		windowHeight  = $window.height();
		bodyHeight    = $body.height();

		if ( sidebarHeight + adminbarOffset > windowHeight ) {
			if ( windowPos > lastWindowPos ) { /*If Scrolling Down...*/
			
				if ( top ) {
					top = false;
					topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
					$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
				} else if ( ! bottom && windowPos + windowHeight > sidebarHeight + $sidebar.offset().top && sidebarHeight + adminbarOffset < bodyHeight ) {
					bottom = true;
					$sidebar.attr( 'style', 'position: fixed; bottom: 125px;' );
				}
			} else if ( windowPos < lastWindowPos ) { /* If Scrolling Up... */
			
				if ( bottom ) {
					bottom = false;
					topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
					$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
				} else if ( ! top && windowPos + adminbarOffset < $sidebar.offset().top ) {
					top = true;
					$sidebar.attr( 'style', 'position: fixed;' );
				}
			} else {
				top = bottom = false;
				topOffset = ( $sidebar.offset().top > 0 ) ? $sidebar.offset().top - adminbarOffset : 0;
				$sidebar.attr( 'style', 'top: ' + topOffset + 'px;' );
			}
		} else if ( ! top ) {
			top = true;
			$sidebar.attr( 'style', 'position: fixed;' );
		}

		if ($sidebar.css('position') ==  'relative'){
			main.attr( 'class', 'site-content col-md-9' );
		}else{
			main.attr( 'class', 'site-content col-md-9 col-md-offset-3' );
		}
		
		lastWindowPos = windowPos;
	}
	
	function collapseOrNot() {

		if ( $( window ).width() < 966) {
			$sidebar.attr('style', 'position: relative; top:0;' );
			$('#sidebar-collapse').attr('class', 'collapse' );
			$('#secondary-toggle').attr('class', 'visible-xs visible-sm collapsed' );
			
		}else {
			$('#sidebar-collapse').attr('class', 'collapse in' );
			$('#secondary-toggle').attr('class', 'visible-xs visible-sm' );
			
		}
	}
	
	$( document ).ready( function() {
		$body          = $( document.body );
		$window        = $( window );
		$sidebar       = $( '#sidebar' ).first();
		adminbarOffset = $body.is( '.admin-bar' ) ? $( '#menu' ).height() : 0;
		
		collapseOrNot();
		$window.on( 'scroll', sideScroll );		
		
	   $(window).on('resize', function () {
			collapseOrNot();		
			sideScroll();//Added as a hack to correct strange behavior on resize, does slow resizing down alot
		});
		
	} );

} )( jQuery );