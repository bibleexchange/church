@extends('layouts.office')

@section('office-content')
	
	
	
	@include('office.partials.deposit_slip')
	
	<a href="/office/deposit/{{$deposit->id}}/print" target="_blank">print</a>
	
	<hr>
	
	@include('office.partials.create_offering', ['deposits'=>$deposits, 'deposit'=>$deposit])	
	
	<hr>
	
	
	<h2>{{$deposit->offerings->count()}} Offerings</h2>
	
	<p>
	@foreach($deposit->offerings as $offering)
		<a href="#{{$offering->name}}">{{ $offering->name }} <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a> | 
	@endforeach
	</p>
	
	@foreach($deposit->offerings as $offering)
	
	<span id ="{{$offering->name}}"></span>
	
	<div id="offering-panels" class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">
	  	<a href="/office/offerings/{{$offering->id}}">({{ $offering->name }}) <strong>${{ $offering->totalAmount() }}</strong></a>
	  	 <a href="/office/gifts/create?offering_id={{$offering->id}}" class="pull-right"><span class="glyphicon glyphicon-plus"></span></a>
	  	</div>
	  
	   <!-- Table -->
	  <table class="table">
        <thead>
          <tr>
          
            <th>$</th>
            <th  colspan="3">Giver</th>
            <th></th>
             <th colspan="2">Memo</th>
          </tr>
        </thead>
        <tbody>

        @foreach ($offering->gifts AS $gift)
          <tr>
            <th scope="row">${{ $gift->totalAmount }}</th>  
            <td colspan="3">{{ $gift->contact->fullName }}</td>
            <td colspan="2">{{ $gift->memo }}</td>
            <th><a data-toggle="modal" href="#myModal{{$gift->id}}" class="btn btn-info btn-sm">edit</a>
            </th>  
          </tr>

<!-- Modal -->
  <div class="modal fade in" id="myModal{{$gift->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">(${{$gift->totalAmount}}) {{$gift->contact->fullName}}</h4>
        </div>
        <div class="modal-body">

       @include('office.partials.create_gift_simple')
 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  		 </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
          
		@endforeach
		<tr style="background-color:rgba(0, 174, 218,.5);"><th colspan="7"></th></tr>

		@include('office.partials.create_gift')
		
        </tbody>
      </table>
	  
	</div>
	@endforeach

@stop