<form action="{{ route('verification.resend') }}" method="post">
	@csrf
	<input type="submit" value="resend email"/>
</form>