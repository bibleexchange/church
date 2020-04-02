<h3>Search:
<input id="sermonssearch" type="text" name="sermonssearch" oninput="filterList(event);" placeholder="enter text" />

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" height="35px" style="width:35px;margin:0;padding:0;" alt="Image result for clear svg icon" onClick="clearSearch(event)">
    <path style="line-height:normal;fill:#f14e32; text-indent:0;text-align:start;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000;text-transform:none;block-progression:tb;isolation:auto;mix-blend-mode:normal" d="M 12.541016 10 L -0.31640625 25 L 12.541016 40 L 13 40 L 46 40 C 48.197334 40 50 38.197334 50 36 L 50 14 C 50 11.802666 48.197334 10 46 10 L 12.541016 10 z M 13.458984 12 L 46 12 C 47.116666 12 48 12.883334 48 14 L 48 36 C 48 37.116666 47.116666 38 46 38 L 13.460938 38 L 2.3164062 25 L 13.458984 12 z M 22.707031 18.292969 L 21.292969 19.707031 L 26.585938 25 L 21.292969 30.292969 L 22.707031 31.707031 L 28 26.414062 L 33.292969 31.707031 L 34.707031 30.292969 L 29.414062 25 L 34.707031 19.707031 L 33.292969 18.292969 L 28 23.585938 L 22.707031 18.292969 z" font-weight="400" font-family="sans-serif" white-space="normal" overflow="visible"/>
</svg>

</h3>
<div id="sermonslist"/>
<script>
    let data = {!! $data->string() !!};

        /*
        Key: "1991/"
        LastModified: "2020-04-01T13:19:38.986Z"
        ETag: ""d41d8cd98f00b204e9800998ecf8427e""
        Size: "0"
        StorageClass: "STANDARD"
        */
        function filterList(event){
            console.log('filtering...')
            render(filter(data.Contents, event.target.value))
        }

        function clearSearch(event){
            console.log('filtering...')
            render(filter(data.Contents, ""))
        }


        render(filter(data.Contents, ''))

        function render(list){
         var element = document.getElementById("sermonslist");

         element.textContent = '';

         var ul = document.createElement("ul");
           let i = 0;

           while ( i < list.length) {
                var li = document.createElement("li")
                var text = document.createTextNode(list[i].Key);

                if(list[i].Key.includes('.') !== false){
                    var a = document.createElement("a")
                    a.href = "https://media.deliverance.me/"+list[i].Key;
                    

                    a.appendChild(text)
                    li.appendChild(a)
                }else{
                   li.appendChild(text)
                }

                ul.appendChild(li);
              i++;
            }
       
           
           element.appendChild(ul);
        }

        function filter(list, search){
            return list.filter(sermon => sermon.Key.toLowerCase().includes(search.toLowerCase())) 
        }
      

</script>

<?php /*
<ul>
@foreach($data->array()["Contents"] AS  $sermon)

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
*/
?>
