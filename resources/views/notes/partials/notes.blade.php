@if(count($notes) < 1)
<p>No notes here yet.</p>

@else

<div id="noteFeed"></div>

<center>
	<img id="loadinggif" src="{!!url('/images/loader.gif')!!}">
	<button class="load_more">Loading...</button>
</center>
	
@endif
