<div class="bs-example">
    <div class="panel-group" id="accordion">
    
    	<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#userMenu">{{ $currentUser->name }}
                    </a>
                </h4>
            </div>
            <div id="userMenu" class="panel-collapse in">
                <div class="panel-body">
				    <p>{!! link_to('/auth/logout', 'Logout') !!}</p>
                </div>
            </div>
        </div>
    	
    	 
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#office">Office</a>
                </h4>
            </div>
            <div id="office" class="panel-collapse collapse">
                <div class="panel-body">

					<p><a href="/office">Dashboard</a></p>
					<p><a href="/office/address">Addresses</a></p>
					<p><a href="/office/contacts">Contacts</a></p>
                    <p><a href="/office/missions?bal=100">Missions</a></p>
                
                </div>
            </div>
        </div>
    	
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#finances">Finances</a>
                </h4>
            </div>
            <div id="finances" class="panel-collapse collapse">
                <div class="panel-body">
                     <p><a href="/office/expenses">Expenses</a></p>
	                <p><a href="/office/deposit">Deposit</a></p>
					<p><a href="/office/offering">Offering</a></p>
					<p><a href="/office/gift">Gift</a></p>
					
						{!! Form::open(array('url'=>'office/print', 'class'=>'well form-inline','role'=>'form','id'=>'deposits')) !!}
						{!! Form::label('deposit_id','Deposit') !!}
						{!! Form::select('deposit_id', Deliverance\Entities\Deposit::selectList()) !!}
						{!! Form::submit('View Deposit', array('class'=>'btn'))!!}
						{!! Form::close() !!}	
						
						{!! Form::open(array('url'=>'office/print', 'class'=>'well form-inline','role'=>'form','id'=>'deposits')) !!}
						{!! Form::submit('View Collection Total', array('class'=>'btn'))!!}
						
						@foreach (Deliverance\Entities\Offering::selectList(10) AS $key => $value)
							<input type="checkbox" name="selectOfferings[]" value="{!!$key!!}" class="form-control">{!!$value!!}
						@endforeach
						
						{!! Form::close() !!}	
                
                </div>
            </div>
        </div>
       
    </div>
</div>
