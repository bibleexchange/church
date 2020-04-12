@extends('studies.common')
	
@section('window')
        <!-- Content -->
<div class="container-fluid">
    <div class="row h1-box greenBG">
     @include('studies.partials.headline',["title"=>$study->present()->Title])
     </div>
</div>

<div class="container-fluid">
	<div id="studies" class="row site justify-content-around">
		<div id="sidebar" class="col-md-4">
			<div class="sidebar">
				<div id="masthead" class="site-header" role="banner">
	
							
	                    <div class="update-image">
		                    <img src="{!!$study->defaultImage->src!!}" alt="{!!$study->defaultImage->alt_text!!}">
		                    <button type="button" class="btn btn-primary btn-xs update-icon" data-toggle="modal" data-target="#iconModal">
			                    <span class="fa fa-edit" aria-hidden="true"></span> <span class="text">update</span>
		                    </button>
	                    </div>
		
	                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#titleModal">
	                     change title
	                    </button>
						
				</div><!-- .site-header -->
	
				<div id="secondary" class="secondary container-fluid">
					
					<div class="row">
						<!-- sidebar seeondary -->
                    	<a class="btn btn-primary btn-xs" href="{!!$study->previewUrl()!!}"><span class="fa fa-eye-close" aria-hidden="true"></span> preview</a>
                   </div>

                   <div class="row">
		            	<a class="btn btn-primary btn-xs" href="{!!$study->url()!!}"><span class="fa fa-eye-open" aria-hidden="true"></span> view public</a>
					</div>
		            <!--  include('studies.forms.modal-create-task')  -->
					<div class="row">
		            <!-- INCLUDE: studies.forms.public-private-study -->
		            @include('studies.forms.public-private-study')
					</div>
					<div class="row">
		            @if($study->isPublished())
			            <a class="btn btn-primary btn-xs all-published" ><span class="fa fa-check" aria-hidden="true"></span> all changes have been published</a>
		            @else
			            <!-- INCLUDE: studies.forms.publish-study -->
			            @include('studies.forms.publish-study')
		            @endif
					</div>
					<div class="row">
		            @include('studies.partials.upload-file')
		            </div>
		            <div class="row">
		            @include('studies.partials.edit-study-extras')	
		        	</div>
					
				</div><!-- .secondary -->
			</div>
		</div><!-- .sidebar -->
		
		<div id="content" class="col-md-8 site-content">
			<!-- Main Content Goes Here like "TEXTBOOK"-->
			
            		<div>
			<div class="col-xs-12">
				<h1>
					<a href="{!! url('/user/course-maker/'.Session::get('last_edited_course_id')) !!}" style="text-decoration: none;">
						<span class="fa fa-arrow-left" aria-hidden="true"></span><sup> last course</sup>
					</a>
					
				</h1>
			</div>
		</div>
		
		@if(Session::has('error'))
			<p class="errors">{{ Session::get('error') }}</p>
		@endif
		
		<div id="course-maker-content">
			<!-- INCLUDE: studies.forms.edit-article -->
			@include('studies.forms.edit-article')
		</div>

		</div><!-- .site-content -->
		
	</div><!-- .row -->
	
</div><!-- .container-fluid -->

		<!-- ./ content -->	

@endsection
