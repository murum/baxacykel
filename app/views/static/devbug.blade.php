@section('content')
	<div class="jumbotron jumbotron-dev-bug">
		<h1>Utvecklande / Buggar</h1>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">Start</a></li>
			<li><a href="#bug" data-toggle="tab">Rapportera bugg</a></li>
			<li><a href="#idea" data-toggle="tab">Idéförslag</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane fade in active" id="home">
				<h2>Information</h2>
				<p>Här kommer vi att samla information om hur du går tillväga för att rapportera buggar samt skicka nya idéer för hur spelet kan bli ännu roligare.</p>

				<p>Vi kommer också att ständigt hålla er uppdaterade om hur det ser ut med ny funktionalitet och hur vi jobbar med eventuella buggar som vi arbetar med. Detta kan du följa på forumet, där vi också diskuterar eventuella frågor och funderingar kring ny funktionalitet.</p>
			</div>
			<div class="tab-pane fade in" id="bug">
				<h2>Rapportera bugg</h2>
				<p>
					När du rapporterar buggar så hjälper du inte bara till med att få spelet att bli buggfritt. Du kommer att när spelet går igång bli belönad med en speciell "medalj" tillsammans med pedaler. 
				</p>

				<div class="alert alert-info">
					Vi ser gärna att du bifogar med en bild på eventuella buggen. För att ladda upp bilder kan du till exempel använda dig utav: <a href="http://pasteboard.co/">http://pasteboard.co/</a>
				</div>

				<form class="form-horizontal" role="form" action="{{ action('BugController@postReport') }}" method="post">
					@if( !Auth::guest() )
						<input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
					@endif

					<div class="form-group">
						<label class="col-sm-4 control-label" for="page">Sida där buggen uppstod</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="page" id="page" placeholder="">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="prio">Prioritering</label>
						<div class="col-sm-8">
							<select class="form-control" name="prio" id="prio">
								<option value="5">Spelet går ej att spela med buggen</option>
								<option value="4">Obalanserat spel med den här buggen</option>
								<option value="3">Spelet går att spela med buggen</option>
								<option value="2">Stör mig i mitt spelande</option>
								<option selected value="1">Inte viktig alls</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="message">Förklarande text kring buggen</label>
						<div class="col-sm-8">
							<textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<input type="submit" value="Skicka" class="btn btn-lg btn-block btn-primary">
						</div>
					</div>
				</form>
			</div>


			<div class="tab-pane fade" id="idea">
				<h2>Idéförslag</h2>
				<p>Ifall du kommer med nya idéer till spelet så kan du komma att bli belönad iform av Pedaler eller till och med riktiga pengar beroende på hur bra din idé är. Vi kommer att göra en bedömning och så snart vi har bedömt din idé och huruvida den blir implementerad eller inte så kommer du också att få din belöning.</p>
				<p class="alert alert-info">För att vi ska veta vem det är som skickar in idén så är det viktigt att du är inloggad.</p>

				<form class="form-horizontal" role="form" action="{{ action('IdeaController@postIdea') }}" method="post">

					@if( !Auth::guest() )
						<input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
					@endif

					<div class="form-group">
						<label class="col-sm-3 control-label" for="idea">Idé</label>
						<div class="col-sm-9">
							<input class="form-control" type="text" name="idea" id="idea" placeholder="">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="message">Förklara idén</label>
						<div class="col-sm-9">
							<textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<input type="submit" value="Skicka" class="btn btn-lg btn-block btn-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
