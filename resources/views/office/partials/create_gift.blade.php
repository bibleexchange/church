<tr>
{!! Form::open(array('url'=>'office/gifts', 'class'=>'well form-inline','role'=>'form','id'=>'gifts')) !!}
{!! Form::hidden('offering_id', $offering->id) !!}
<td colspan="3">		 	
		<select class="js-example-basic-single form-control" name="contact_id">
		  @foreach($givers AS $giver)
		  	<option value="{{$giver->id}}" selected="selected">{{$giver->fullName}}</option>
		  @endforeach
		</select>
</td>
<td>		

		{!! Form::text('other', NULL, array('class'=>'', 'placeholder'=>'Check amount')) !!}	
</td>
<td>		
		{!! Form::text('seriel', NULL, array('class'=>'', 'placeholder'=>'Seriel Number')) !!}	
</td>
<td colspan="2">		
		{!! Form::text('memo', null, array('class'=>'', 'placeholder'=>'Memo')) !!}	
</td>

</tr>

<tr>
<td>		
		{!! Form::text('penny', NULL, array('class'=>'', 'placeholder'=>'.01')) !!}
</td>
<td>		
		{!! Form::text('nickel', NULL, array('class'=>'', 'placeholder'=>'.05')) !!}
</td>
<td>		
		{!! Form::text('dime', NULL, array('class'=>'', 'placeholder'=>'.10')) !!}
</td>
<td>		
		{!! Form::text('quarter', NULL, array('class'=>'', 'placeholder'=>'.25')) !!}
</td>
<td>		
		{!! Form::text('halfD', NULL, array('class'=>'', 'placeholder'=>'.50')) !!}
</td>

<td></td>

<td>
<button class="btn success" type="submit" value="NEW Gift"><span class="glyphicon glyphicon-ok"></span></button>
</td>

</tr>
<tr>
<td>		
		{!! Form::text('oneD', NULL, array('class'=>'', 'placeholder'=>'$1')) !!}
</td>
<td>		
		{!! Form::text('twoD', NULL, array('class'=>'', 'placeholder'=>'$2')) !!}
</td>
<td>		
		{!! Form::text('fiveD', NULL, array('class'=>'', 'placeholder'=>'$5')) !!}
</td>
<td>		
		{!! Form::text('tenD', NULL, array('class'=>'', 'placeholder'=>'$10')) !!}
</td>
<td>		
		{!! Form::text('twentyD', NULL, array('class'=>'', 'placeholder'=>'$20')) !!}
</td>
<td>		
		{!! Form::text('fiftyD', NULL, array('class'=>'', 'placeholder'=>'$50')) !!}
</td>
<td>		
		{!! Form::text('hundredD', NULL, array('class'=>'', 'placeholder'=>'$100')) !!}
</td>

{!! Form::close() !!}

</tr>

@section('scripts')
			<script type="text/javascript">
			$(document).ready(function() {
				  $(".js-example-basic-single").select2();
				});
			</script>
@stop