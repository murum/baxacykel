<!doctype html>
<html lang="sv">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>
		@if(isset($title))
			{{ $title }}
		@else
			Baxacykel - Baxa, Flaxa, Maxa
		@endif

	</title>
	{{ HTML::style('/assets/stylesheets/frontend.css?v=100') }}
</head>
<body class="chat-body">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="messages">
					<ul>
						@foreach ($messages as $message)
						    @if($message->user()->first()->id !== Auth::user()->id)
						    <li class="message">
						    @else
							<li class="message right">
							@endif
								<div class="row">
									<div class="col-xs-12">
                                        <div class="row chat-meta">
                                            <div class="col-xs-12">
                                                @if($message->user()->first()->role_level == Role::ADMIN)
                                                    <h6 class="chat-username admin">
                                                        <i class="fa fa-user"></i>
                                                        <a target="_parent" href="/anvandare/{{ $message->user()->first()->id}}">{{ $message->user()->first()->username }}</a>
                                                    </h6>
                                                @elseif($message->user()->first()->role_level == Role::MODERATOR)
                                                    <h6 class="chat-username moderator">
                                                        <i class="fa fa-user"></i>
                                                        <a target="_parent" href="/anvandare/{{ $message->user()->first()->id}}">{{ $message->user()->first()->username }}</a>
                                                    </h6>
                                                @else
                                                    <h6 class="chat-username">
                                                        <i class="fa fa-user"></i>
                                                        <a target="_parent" href="/anvandare/{{ $message->user()->first()->id}}">{{ $message->user()->first()->username }}</a>
                                                    </h6>
                                                @endif
                                                <span class="chat-meta-time"><i class="fa fa-clock-o"></i>{{ $message->get_message_time() }}</span>
                                            </div>
                                        </div>

                                        <span class="chat-speech-bubble top-left">
                                            {{ strip_tags($message->message) }}
                                        </span>
									</div>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="add-message">
					<form action="/skicka-chatt-meddelande" action="post">
						{{ Form::token() }}
						<div class="row">
							<div class="col-xs-12">
								<input type="text" id="chat-message-input" class="form-control" name="message">
							</div>
						</div>
						<div class="row chat-submit">
							<div class="col-xs-12">
								<input type="submit" class="btn btn-block btn-sm btn-success" value="Skicka" name="chat-submit">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		var BASE_URL = "{{ Config::get('app.custom_path'); }}"
	</script>
	{{ HTML::script('/assets/javascript/frontend.js') }}
</body>
</html>
