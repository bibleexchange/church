@extends('layouts.app')

@section('content')

            <div class="card">
            <h2>LIVE STREAM</h2>
                <div class="contents">

                <iframe width="100%" height="315" src="https://www.youtube.com/embed/live_stream?channel=UC3M6eX6w0iZ6WcowSNokq2g" frameborder="0" allowfullscreen="" class="ui-droppable"></iframe>
                    
                </div>

				<div class="contents">

				

				<p>We stream live audio of all of our church services for those that are unable to physically join us. The audio should automatically start playing on this page if the on air signal is displaying.</p>

				<p>If the stream is not on air during the scheduled times, we may be experiencing technical difficulty.</p>

				<p>To report any problem with the stream, please visit our Facebook page or send us a Tweet and let us know what's going on. We will try to respond and fix the problem as soon as possible.</p>
                </div>
            </div>

                  <div class="card">
                    <div class="contents">
                    <h1>Sermons</h1>
                    @include('partials.sermons')
                  </div>
            </div>
@endsection
