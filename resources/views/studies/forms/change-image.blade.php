{!! Form::open(['url'=>'/study/upload-study-icon/'.$study->title,'files'=>true]) !!}
      
      {!! Form::file('file') !!}
   	
   		<hr>
   	
         <button type="submit" class="btn btn-primary">
             <i class="fa fa-upload"></i>
              <span>Upload</span>
          </button>
{!! Form::close() !!}