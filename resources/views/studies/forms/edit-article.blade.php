{!!Form::open(['id'=>'studyeditor','class'=>'editor'])!!}	
	
			{!! Form::hidden('title',$study->title,['id'=>'title']) !!}
						
			{!! Form::label('text','Body: ') !!}
			
				<button type="button" class="" data-toggle="modal" data-target="#myModal">
				 (optional) upload from .md file
				</button>
			
			<textarea id="text" placeholder="Start the body of your study here. Use markdown to style the text." class="col-12" rows="15"></textarea>


			{!! $errors->first('text', '<br><small style=\'color:red;\'>*:message</small>') !!}
			
			{!! Form::label('comment','Editing Comments: ') !!}
			{!! Form::text('comment', $form->comment ,['id'=>'comment','placeholder'=>'EXAMPLE: This is the first text written in this study']) !!}
			{!! $errors->first('comment', '<br><small style=\'color:red;\'>*:message</small>') !!}
			
			<div class="form-group">
				{!! Form::label('minor_edit','Minor Edit?: ') !!}
				{!! Form::checkbox('minor_edit','1', true, ['id'=>'minor_edit']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('translate_verses','Convert Verse Code?: ') !!}
				{!! '{% John 3:16 %}' !!}	
				{!! Form::checkbox('translate_verses','1', false, ['id'=>'translate_verses']) !!}	
			</div>
			
			{!! Form::submit('save',['id'=>'save','class'=>'btn btn-success']) !!} 			
			
{!!Form::close()!!}
