@section('content')
<div class="jumbotron">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<form role="form" action="{{ action('AuthController@postRegister') }}" method="post">
			    <h2 class="form-signup-heading">Registrering</h2>
			    {{ Form::token(); }}

			    <div class="form-group">
					<label for="username">Användarnamn</label>
					<input type="text" class="form-control" id="username" value="{{ Input::old('username') }}" name="username" />
				</div>
				<div class="form-group">
					<label for="email">E-post</label>
					<input type="text" class="form-control" id="email" value="{{ Input::old('email') }}" name="email" />
				</div>
				<div class="form-group">
					<label for="pass">Lösenord</label>
					<input type="password" class="form-control" id="password" name="password" />
				</div>
				<div class="form-group">
					<label for="password_confirmation">Bekräfta lösenord</label>
					<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
				</div>
				<div class="form-group">
					<label for="reference_username">Tipsad av</label>
					@if(isset($referral_user))
						<input type="text" class="form-control" id="reference_username" value="{{ $referral_user->username }}" name="reference_username" />
					@else 
						<input type="text" class="form-control" id="reference_username" value="{{ Input::old('reference_username') }}" name="reference_username" />
					@endif
				</div>
				<div class="form-group rules">
					<label><input type="checkbox" name="rules"> Jag accepterar <a href="#rules_header">reglerna</a> för Baxacykel samt intygar att jag är 18 år eller äldre eller har mina föräldrars tillåtelse att spela BaxaCykel.</label>
				</div>
			 
			    {{ Form::submit('Registrera', array('class'=>'btn btn-large btn-primary btn-block'))}}
			</form>
		</div>
		<div class="col-xs-12 col-md-6 terms-rules">
			<h2 id="rules_header">Regler</h2>
			<p>
				Samtliga regler gäller överallt hos Baxacykel.
			</p>
			<p>
				1. Du är själv ansvarig för ditt konto, pedaler som är köpta hos baxacykel.se kan återställas ifall det finns bevis av felaktigt införskaffande. Kontot kommer aldrig att återställas eller rullas tillbaka om det ej har skett av administratörer på Baxacykel
			</p>
			<p>
				2. Det är ej tillåtet att spela / logga in på någon annan spelares konto.
			</p>
			<p>
				3. Kontot som du har skapat får aldrig säljas eller överlämnas till någon.
			</p>
			<p>
				4. Det är förbjudet att spela med mer än ett konto samtidigt. Detta innebär alltså att du endast får ha ett konto registrerat. Ifall du har blivit avstängd en gång så kommer också kommande konton att bli avstängda.
			</p>
			<p>
				5. Det är inte tillåtet att stjäla eller missbruka en annan spelares konto. Detta inkluderar försök att komma åt en annan spelare konto.
			</p>
			<p>
				6. Buggar som hittas ska rapporteras på en gång och användande av en bugg som ej rapporteras kommer att resultera i straff.
			</p>
			<p>
				7. Det är strikt förbjudet att spamma eller kladda ner spelet. Det är även förbjudet att göra reklam för något utan administratörens tillstånd.
			</p>
			<p>
				8. Det är förbjudet att trakassera, skicka länkar eller innehåll som innehåller pornografisk, rasistiskt, nazistiskt eller annat material som kränker folkgrupper eller individer. Politiska och religösa uttalanden är inte tillåtna. Rapporter mot denna regel kommer att granskas från fal till fall och administratören i samråd med Moderatorer har friheten att bestämma straffet. Vid grova brott kopplas Polis in i ärendet.
			</p>
			<p>
				9. Alla handlingar i spelet måste utföras av dig närvarande vid den enhet du spelar på, mobil, tablet eller dator. All navigering runt i spelet måste utföras av dig som spelare genom det tillhandahållna klickverktyget (mus, touchpad, skärm). Detta innebär att manipulering av URLer eller webbläsar tilläg är strikt förbjudet i den mån det påverkar spelet.
			</p>
			<p>
				10. Betalningar som inte är registrerade i våra system kommer ej att kompenseras. Vi på Baxacykel står ej till svar för förlust av pengar. I de fall som pengar förloras så skall de rapporteras till betalningsleverantören eller operatören.
			</p>
			<p>
				11. Det är förbjudet att vilseleda teamet bakom Baxacykel eller uppträda som en av teamet bakom Baxacykel ifall du ej är en del av Baxacykel.
			</p>
			<p>
				12. Varje överträdelse av användarvillkoren är förbjuden
			</p>
			<p>
				13. Det är förbjudet att köpa, sälja och byta pedaler på annat sätt än det som tillhanda hålls av Baxacykel. 
			</p>
			<p>
				14. All brottsligverksamhet som bryter mot Sverige lagar anmäls till Svensk Polis
			</p>
			<p>
				15. Reglerna kan ändras när som helst och det är upp till dig som spelare att se till att du är uppdaterad.
			</p>
		</div>
	</div>
</div>
@stop