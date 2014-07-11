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
			<h2 class="form-signup-heading">Inloggning</h2>
			<form role="form" action="{{ action('AuthController@post_login') }}" method="post">
				{{ Form::token(); }}
				<div class="form-group">
					<label for="login-email">Email</label>
					<input type="text" class="form-control" id="login-email" name="login-email" />
				</div>
				<div class="form-group">
					<label for="login-pass">Lösenord</label>
					<input type="password" class="form-control" id="login-pass" name="login-pass" />
				</div>
				<button type="submit" class="btn btn-primary">Logga in</button>
			</form>
		</div>
	</div>
@stop
