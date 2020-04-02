<div id="sermonslist"/>
<script>
    let data = {!! $data->string() !!};
    console.log(data)
        /*
        Key: "1991/"
        LastModified: "2020-04-01T13:19:38.986Z"
        ETag: ""d41d8cd98f00b204e9800998ecf8427e""
        Size: "0"
        StorageClass: "STANDARD"
        */

        render(data.Contents)

        function render(list){
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
       
           var element = document.getElementById("sermonslist");
           element.appendChild(ul);
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
