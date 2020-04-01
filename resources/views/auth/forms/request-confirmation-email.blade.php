<form action="{{ route('confirm_email') }}" method="post">
	@csrf
	<input type="submit" value="resend email"/>
</form>