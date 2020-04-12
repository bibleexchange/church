<?php
	$colors = ['blueBG','greenBG','blueBG','greenBG','blueBG','greenBG','blueBG','greenBG','blueBG','greenBG','blueBG','greenBG'];
	$counter = 0;

    $bgColor = $colors[$counter]; $counter++; 
?>
	<div id="sidebar-collapse" class="d-md-none collapse">
				
		@include('studies.partials.aside-core')
						
	</div><!--End sidebar-collapse-->

  <div class="d-none d-md-block">
				
	@include('studies.partials.aside-core')
						
</div><!--End sidebar-collapse-->
