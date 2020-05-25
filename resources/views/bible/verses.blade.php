@extends('layouts.default')

@section('styles')

  #feedback	{
  	background-color:#fff;
  	width:100%;
  	z-index:50;
  }

  #dismiss-selectable {
  	z-index:50;
  	width:10000px;
  	height:10000px;
  	position:absolute;
  	top:-2000px;
  	left:0;
  	background: rgba(255, 255, 255, 0.5);
  	z-index:-5;
  }
  
  #feedback.animated.off {
  	display:none;
  }
  
  #feedback {
  	position:fixed;
  	bottom:0;
  	padding: 2rem 5rem 5rem 5rem;
  }
  
  #feedback p {margin:15px;}
  
  #bible .ui-selecting { background: #67818a; }
  #bible .ui-selected { background: #ADD8E6 }
  
  .bible-highlight {
  	border-radius:15%;
  	padding:0;
  	border-style: dashed; 
  	border-left:none; 
  	border-right:none;
	}
  
@stop

@section('content')
	<div id="feedback" class="row animated off bible">
		
		<button id="dismiss-selectable" class="btn btn-warning btn-xs" onclick="deselectSelectable()">clear</button>
		
		@include('bible.forms.highlight')
		<span id="select-reference"></span>
		<span id="dynamic-verse-info"></span>
		
		@if($currentUser)
			<!-- INCLUDE: notes.partials.publish-scripture-note-js' -->
			<!-- @include('notes.partials.publish-scripture-note-js-min') -->
		@endif
	</div>
	<div class="row blueBG" style="margin-bottom:25px; text-align:center;">
		<div class="container">
			<div class="col-xs-12">	
				{{$currentReference}}
			</div>
		</div>
	</div>
	
	<div class="d-flex justify-content-center">
	

		
			<div id="bible" style="width:50%;">
				
				<?php 
					$chapter = null;
					?>

				@foreach($verses AS $v)

				 	@if($chapter !== $v->chapter)
				 	<h2 style="text-align: center;">{{$v->book_name}} {{$v->chapter}}</h2>
				 	<?php $chapter = $v->chapter; ?>
				 	@endif

					<p title="{{$v->reference}}" id="{{$v->id}}" class="ui-widget-content">
						<sup>{{$v->v}}</sup>

						@if($currentUser && $v->userHighlight($currentUser) !== null)		
<?php 

$color = $v->userHighlight($currentUser)->color();

/*						
							<?php 
							$words = explode(' ', strip_tags($v->kjvrText()));
							
							?>
							
							@foreach($words AS $word)
									
								<mark class="bible-highlight" style="border-style: solid; border-top:none; border-left:none; border-right:none; border-bottom-color:{{$color}};"> {{ $word }}</mark>
						
							@endforeach
*/
?>
							<mark class="bible-highlight" style="border-color:{{$color->strong}}; background-color:{{$color->subtle}};">
							 {!! $v->kjv->t !!}
							</mark>
						
						
						@else
							<b>{!! $v->number !!}</b> {!! $v->kjv->t !!}
						@endif
					</p>
				@endforeach


		</div>
		
		
	</div>

@stop

@section('scripts')
	<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript">
		@include('partials.jquery-selectable-test')
	</script>
@stop
