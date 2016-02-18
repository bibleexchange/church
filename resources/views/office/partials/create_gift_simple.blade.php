{!! Form::open(array('url'=>'/office/gifts/'.$gift->id, 'class'=>'form-inline','role'=>'form')) !!}
{!! Form::hidden('offering_id', $offering->id) !!}
		 	
		{{ $gift->contact->fullName}}: {!! Form::text('contact_id', $gift->contact->id, array('class'=>'', 'placeholder'=>'giver')) !!}

		Check: {!! Form::text('other', $gift->other, array('class'=>'', 'placeholder'=>'Check amount')) !!}	
	
		Seriel: {!! Form::text('seriel', $gift->seriel, array('class'=>'', 'placeholder'=>'Seriel Number')) !!}	
		
		Memo: {!! Form::text('memo', $gift->memo, array('class'=>'', 'placeholder'=>'Memo')) !!}	

		.01: {!! Form::text('penny', $gift->penny, array('class'=>'', 'placeholder'=>'.01')) !!}
	
		.05: {!! Form::text('nickel', $gift->nickel, array('class'=>'', 'placeholder'=>'.05')) !!}
		
		.10: {!! Form::text('dime', $gift->dime, array('class'=>'', 'placeholder'=>'.10')) !!}
		
		.25: {!! Form::text('quarter', $gift->quarter, array('class'=>'', 'placeholder'=>'.25')) !!}
		
		.50: {!! Form::text('halfD', $gift->halfD, array('class'=>'', 'placeholder'=>'.50')) !!}
		
		$1: {!! Form::text('oneD', $gift->oneD, array('class'=>'', 'placeholder'=>'$1')) !!}
		
		$2: {!! Form::text('twoD', $gift->twoD, array('class'=>'', 'placeholder'=>'$2')) !!}
		
		$5: {!! Form::text('fiveD', $gift->fiveD, array('class'=>'', 'placeholder'=>'$5')) !!}
		
		$10: {!! Form::text('tenD', $gift->tenD, array('class'=>'', 'placeholder'=>'$10')) !!}
		
		$20: {!! Form::text('twentyD', $gift->twentyD, array('class'=>'', 'placeholder'=>'$20')) !!}
		
		$50: {!! Form::text('fiftyD', $gift->fiftyD, array('class'=>'', 'placeholder'=>'$50')) !!}
		
		$100: {!! Form::text('hundredD', $gift->hundredD, array('class'=>'', 'placeholder'=>'$100')) !!}
		
		        <button class="btn btn-success" type="submit" value="save changes"><span class="glyphicon glyphicon-ok"></span></button>
		
{!! Form::close() !!}