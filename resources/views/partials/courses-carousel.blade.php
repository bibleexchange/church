<div id="carousel-example-generic" class="carousel slide redBGtrans" data-ride="carousel">
  <ol class="carousel-indicators">

  <?php $active = 'active'; $count = 0;?>  
  
 	@foreach($courses AS $course)
  
    <li data-target="#carousel-example-generic" data-slide-to="{{$count}}" class="{{$active}}"></li>
    
	<?php $active = ''; $count = $count + 1; ?>
	  
	@endforeach

  </ol>
  <div class="carousel-inner">

    {{-- items --}}
     <?php $active = 'active'; $count = 0;?>  
     
     @foreach($courses AS $course)

	    <div class="carousel-item {{$active}}">
	    
	    	<div style="position:absolute; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,.2); z-index:-5;">&nbsp;</div>
	      	<span class="badge pull-right" style="margin:10px;">{!! $course->studies(true)->count() !!} studies</span>
	    	<img style="height:250px; z-index:-10;" class="main-image" src="{!! $course->defaultImage->src !!}" alt="{!! $course->defaultImage->alt_text !!}" id="{!! $course->defaultImage->name !!}">	    
	      <div class="carousel-caption">
	        <h2>{{$course->title}}</h2>
	        
	        <p class="description hidden-sm hidden-xs">{!! $course->description !!}</p>
	        
	         <p>
			        
			    
				@if($course->isPublic())
				<a class="btn btn-xs btn-primary" href="{!! $course->url() !!}"><span class="fa fa-eye-open" aria-hidden="true"></span>&nbsp;&nbsp;View</a>
				
				@else
				<a class="btn btn-xs btn-default"><span class="fa fa-eye-close" aria-hidden="true"></span></a>
				
				@endif
				
				@if($currentUser && $currentUser->id === $course->user_id)
				<a class="btn btn-xs btn-success" href="{!! $course->editUrl() !!}">Edit</a>
				@endif
		
			</p>
	        
	      </div>
	      
	    </div>
    	
    	<?php $active = ''; $count = $count + 1; ?>
    	
	  @endforeach  
    [{-- items end --}]

  <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
