<h2>{!! $addresses->count() !!} (maine: {!! $maine->count() !!}) (out of state: {!! $outOfState->count() !!})</h2>

@foreach($addresses AS $address)

	<p>{!! $address->defaultAddressee !!}, {!! $address->address !!}, {!! $address->city !!}, {!! $address->state !!}, {!! $address->zip !!}</p>

@endforeach