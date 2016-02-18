 {!! Form::open(array('url'=>'office/gifts', 'class'=>'well form-inline','role'=>'form','id'=>'gifts')) !!}
<div class="form-group">
{!! Form::hidden('offering_id', $offering->id) !!}
</div>

	<div class="form-group">
		{!! Form::label('contact_id','Giver: ') !!}
		 	
		<select class="js-example-basic-single form-control" name="select-boxes">
		  @foreach($givers AS $giver)
		  	<option value="{{$giver->id}}" selected="selected">{{$giver->fullName}}</option>
		  @endforeach
		</select>
		
		</h3>
	</div>
			
	<div class="col-xs-12">
		<div class="form-group checkamount">
			<img src="/images/finances/blankCheckAmount.jpg" alt="Check" >
			{!! Form::label('other','Check') !!}
			{!! Form::text('other', NULL, array('class'=>'', 'placeholder'=>'Check amount')) !!}	
		</div>
		<div class="form-group checkseriel">
			<img src="/images/finances/blankCheckNu.jpg" alt="Check" >
			{!! Form::label('seriel','Check #') !!}
			{!! Form::text('seriel', NULL, array('class'=>'', 'placeholder'=>'Seriel Number')) !!}	
		</div>
		<div class="form-group memo">
			{!! Form::label('memo','Memo') !!}
			{!! Form::text('memo', null, array('class'=>'', 'placeholder'=>'Memo')) !!}	
		</div>
	</div>

	<div class="col-xs-6">
		<div class="form-group">
			<img src="/images/finances/penny.png" alt="Check" >
			{!! Form::label('penny','Pennies') !!}
			{!! Form::text('penny', NULL, array('class'=>'', 'placeholder'=>'Pennies')) !!}
		</div>
		<div class="form-group">
			<img src="/images/finances/nickel.png" alt="Check" >
			{!! Form::label('nickel','Nickels') !!}
			{!! Form::text('nickel', NULL, array('class'=>'', 'placeholder'=>'Nickels')) !!}
		</div>
		<div class="form-group">
			<img src="/images/finances/dime.png" alt="Check" >
			{!! Form::label('dime','Dimes') !!}
			{!! Form::text('dime', NULL, array('class'=>'', 'placeholder'=>'Dimes')) !!}
		</div>
		<div class="form-group">
			<img src="/images/finances/quarter.png" alt="Check" >
			{!! Form::label('quarter','Quarters') !!}
			{!! Form::text('quarter', NULL, array('class'=>'', 'placeholder'=>'Quarters')) !!}
		</div>
		<div class="form-group">
			<img src="/images/finances/half.png" alt="Check" >
			{!! Form::label('halfD','Half Dollar') !!}
			{!! Form::text('halfD', NULL, array('class'=>'', 'placeholder'=>'Half Dollar')) !!}
		</div>
		
	</div>
	<div class="col-xs-6">
		<div class="form-group">
		<img src="/images/finances/one.png" alt="Check" >
		{!! Form::label('oneD','Ones') !!}
		{!! Form::text('oneD', NULL, array('class'=>'', 'placeholder'=>'Ones')) !!}
		</div>
		<div class="form-group">
		<img src="/images/finances/two.png" alt="Check" >
		{!! Form::label('twoD','Twos') !!}
		{!! Form::text('twoD', NULL, array('class'=>'', 'placeholder'=>'Twos')) !!}
		</div>
		<div class="form-group">
		<img src="/images/finances/five.png" alt="Check" >
		{!! Form::label('fiveD','Fives') !!}
		{!! Form::text('fiveD', NULL, array('class'=>'', 'placeholder'=>'Fives')) !!}
		</div>
		<div class="form-group">
		<img src="/images/finances/ten.png" alt="Check" >
		{!! Form::label('tenD','Tens') !!}
		{!! Form::text('tenD', NULL, array('class'=>'', 'placeholder'=>'Tens')) !!}
		</div>
		<div class="form-group">
		<img src="/images/finances/twenty.png" alt="Check" >
		{!! Form::label('twentyD','Twenties') !!}
		{!! Form::text('twentyD', NULL, array('class'=>'', 'placeholder'=>'Twenties')) !!}
		</div>
		<div class="form-group">
		<img src="/images/finances/fifty.png" alt="Check" >
		{!! Form::label('fiftyD','Fifties') !!}
		{!! Form::text('fiftyD', NULL, array('class'=>'', 'placeholder'=>'Fifties')) !!}
		</div>
		<div class="form-group">
		<img src="/images/finances/hundred.png" alt="Check" >
		{!! Form::label('hundredD','Hundreds') !!}
		{!! Form::text('hundredD', NULL, array('class'=>'', 'placeholder'=>'Hundreds')) !!}
		</div>
	</div>

{!! Form::submit('NEW Gift', array('class'=>'btn'))!!}

{!! Form::close() !!}

@section('scripts')
			<script type="text/javascript">
			$(document).ready(function() {
				  $(".js-example-basic-single").select2();
				});
			</script>
@stop