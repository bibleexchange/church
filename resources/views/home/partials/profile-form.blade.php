{!! Form::open(['route'=>'settings.store','files'=>'true']) !!}
	
    <fieldset>
    	 <br>
		  <div class="input-group">
		 	<span class="input-group-addon" id="name"><span class="fa fa-gravatar" aria-hidden="true"></span> Name: </span>	 	

		 	{!! Form::text('name', $currentUser->name,['class'=>'form-control','placeholder'=>'my name','required' => 'required','aria-describedby'=>'basic-addon1']) !!}
			{!! $errors->first('name', '<small style=\'color:red;\'>*:message</small>') !!}
			</div>

    	 <br>
 		  <div class="input-group">
		 	<span class="input-group-addon" id="middlename"><span class="fa fa-gravatar" aria-hidden="true"></span> Unique Bible exchange handle/nickname: </span>	 	
			
			{!! Form::text('nickname', $currentUser->nickname,['class'=>'form-control','placeholder'=>'my nickname or initial','required' => 'required','aria-describedby'=>'basic-addon1']) !!}
			{!! $errors->first('nickname', '<small style=\'color:red;\'>*:message</small>') !!}
			
			</div>
		
         <br>
         
          <div class="input-group">
		 	<span class="input-group-addon" id="profile_image"><span class="fa fa-gravatar" aria-hidden="true"></span> Pofile Image*: </span>	 

		 	<img class="media-object" src="{!! $currentUser->gravatar(100) !!}" alt="{!! $currentUser->email !!}">	

			{!! Form::file('profile_image',['id'=>'file_upload', 'class'=>'btn btn-primary', 'onChange'=>'loadFile(event)']) !!}
			{!! $errors->first('profile_image', '<small style=\'color:red;\'>*:message</small>') !!}

			<img id="output" width="200" />
			<button id="clear-file" class="d-none" onClick="clearFile()"></button>
			</div>
			
			<script>

				let clearEl = document.getElementById("clear-file");

				function clearFile(e){
					clearEl.innerHTML = '';
					clearEl.classList.add('d-none');
					event.preventDefault();
					console.log("clearing input...")
					var elem = document.getElementById("file_upload");
					elem.value = "";

					var image = document.getElementById('output').src = '';
				}

				var loadFile = function(event) {
					var image = document.getElementById('output');
					image.src = URL.createObjectURL(event.target.files[0]);
					clearEl.innerHTML = 'clear';
					clearEl.classList.remove('d-none');
				};
			</script>

			<p>*To continue using Gravator as your profile image just skip this field.</p>

	<br><br>
        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </fieldset>
{!! Form::close() !!}
