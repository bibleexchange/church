<div id="editor">
	<main>
		<form method="post">
			<input type="submit" />
		    <textarea id="data" name="data">$text</textarea>
		    <input id="uuid"  name="uuid" type="hidden" value=$uuid/>
		    
		</form>
	</main>

	<aside>
		<a href="/blog/$uuid">view</a>
		$output
	</aside>

</div>