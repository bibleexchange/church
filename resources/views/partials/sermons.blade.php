<ul>
@foreach(App\Sermon::xml() AS  $sermon)

    @if(strpos($sermon["Key"], ".") !== false)
    <li>{{$sermon["Key"]}}<br />
        <audio controls="" autoplay="false" name="media">
            <source src={{"https://media.deliverance.me/" . $sermon["Key"] }} type="audio/mp3">
        </audio>
        <hr/>
    </li> 
    @endif
@endforeach
</ul>
