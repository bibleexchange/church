(function($){
	"use strict";
	
	var fn={Launch:function(){document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio"in window?","+devicePixelRatio:",1")+'; path=/';
	
	fn.MenuSticky();
	fn.MenuStickyClose();
	fn.AnimatedHiddenMenu();
	},
	
	MenuSticky:function(){
	
		var menu=document.querySelector('#menu'),origOffsetY=menu.offsetTop+155;
		
		var lastScrollTop = 0,
        st,
        direction;

    function detectDirection() {

        st = window.pageYOffset;

        if (st > lastScrollTop) {
            direction = "down";
        } else {
            direction = "up";
        }

        lastScrollTop = st;

        return  direction;

    }
		
		function scroll(){
		
			var currentClass = $('#menu').attr('class');
			
				if(detectDirection() == 'up' && $(window).scrollTop() > 1){
					if (currentClass != 'slideInDown')
					{
					$('#menu').addClass('slideInUp navbar-fixed-top');
					}
				}else{
					$('#menu').removeClass('slideInUp navbar-fixed-top');
				}
		}
		
		document.onscroll=scroll;
	},
	
	AnimatedHiddenMenu__off:function(){
		var btn=$("#menu-toggle");
		var menuState = $('#navbar').attr('class');
		var classToAdd, classToRemove;
		
		btn.on("click",null,null,function(){
			
			var menuState = $('#navbar').attr('class');

			if(menuState == 'collapse'){
				classToAdd = 'animated slideInRight';
				classToRemove = 'animated slideOut';
			}else{
				classToAdd = 'animated slideOut';
				classToRemove = 'animated slideInRight';
			}
			console.log(classToAdd);
			$('#collapsible-menu').addClass(classToAdd);
			$('#collapsible-menu').removeClass(classToRemove);
			
		});
		
	},

	MenuStickyClose:function(){
		var navMain=$("#menu");	
		navMain.on("click","a",null,function(){navMain.collapse('hide');});
	},
	
	MainSliderAlign:function(){
		var imageWidth,widthFix,container=$('.header-bg-');
		function centerImage(){imageWidth=container.find('img').width();
			widthFix=imageWidth/2;
			container.find('img').css('margin-left',-widthFix);
		}
	}
};
	
	$(document).ready(function(){fn.Launch();
	
	});
	})(jQuery);