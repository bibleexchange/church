	<div class="row">
		@foreach($studies AS $s)
			<div class="col-12 col-sm-6 col-md-4" style="margin-bottom:15px;">
				<!-- INCLUDE: studies.partials.study-preview -->
				@include('studies.partials.study-preview',['study'=>$s])
			</div>
		@endforeach
	</div>
