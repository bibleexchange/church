@extends('layouts.default')

@section('content')

@if($query !== false)

<h1>Search Results for: "{!!$query!!}"</h1>
<center>
@if ($bibleVerses->total() >= $lessons->total() && $bibleVerses->total() >= $bibleBooks->total())
	{!! $bibleVerses->render() !!}
@elseif ($lessons->total() > $bibleVerses->total() && $lessons->total() >= $bibleBooks->total())
	{!! $lessons->render() !!}
@else {
	{!! $bibleBooks->render() !!}
@endif
</center>
<div class="row">

		@if(!empty($lessons))
			<div class="col-md-5">
			<h2>Lessons found: ({!! $lessons->total() !!})</h2>
			<ul>
			@foreach($lessons AS $l)
			
				<li><a href="{!!$l->defaultUrl!!}">{!!$l->title!!}</a></li>
				
			@endforeach
			</ul>
			</div>
		@endif
		
		@if(!empty($bibleVerses))
			<div class="col-md-5">
			<h2>Bible Verses found: ({!! $bibleVerses->total() !!})</h2>

			@foreach($bibleVerses AS $v)
			
				<li><a href="{!!$v->url()!!}">{!!$v->reference!!}</a> {!!$v->focus($query)!!}</li>
				
			@endforeach
			</ul>
			</div>
		@endif
		
		@if(!empty($bibleBooks))
			<div class="col-md-2">
			<h2>Bible Books found: ({!! $bibleBooks->total() !!})</h2>
			<ul>
			@foreach($bibleBooks AS $b)
			
				<li><a href="{!!$b->url()!!}">{!!$b->n!!}</a></li>
				
			@endforeach
			</ul>
			</div>
		@endif
</div>
	
@endif	
	
@stop