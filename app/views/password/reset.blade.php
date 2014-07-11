@section('message')
	@if(isset($message))
	<section class="message">
		<div class="alert alert-info">
			<strong>{{ $message }}</strong>
		</div>
	</section>
	@endif
	@if(isset($error))
	<section class="message">
		<div class="alert alert-danger">
			<strong>{{ $error }}</strong>
		</div>
	</section>
	@endif
	@if(isset($success))
	<section class="message">
		<div class="alert alert-success">
			<strong>{{ $success }}</strong>
		</div>
	</section>
	@endif
@stop

@section('content')
	<div class="row">
		<div class="col-xs-offset-1 col-xs-10 col-md-offset-4 col-md-4">
			<h1>Glömt lösenord</h1>
			<form action="{{ action('RemindersController@postReset') }}" method="POST">
			    <input type="hidden" name="token" value="{{ $token }}">
			    <input type="email" name="email">
			    <input type="password" name="password">
			    <input type="password" name="password_confirmation">
			    <input type="submit" value="Reset Password">
			</form>
		</div>
	</div>
@stop