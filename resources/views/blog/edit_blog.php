<div id="my-content" contenteditable="true">$text</div>

<form action="/edit/blog/update" method="post" onsubmit="getContent();">
    <input id="config"  name="data" type="text" style="display:none;" value="empty at first"/>
    <input type="submit" />
</form>

<form action="/edit/blog/new-post" method="post">
    <input id="uuid"  name="uuid" type="text"  value=""/>
    <input type="submit" />
</form>

<script>
    function getContent(e){
          if(false)
		  {
		   // alert("validation failed false");
		    //returnToPreviousPage();
		    return false;
		  }

		  document.getElementById("config").value = document.getElementById("my-content").innerHTML;
		  return true;

    }
</script>