@section('content')
	<div class="jumbotron">
		<h1>Changelog för Baxacykel.se</h1>
		<div class="changelog">
			<h2>Nyheter under vecka 13</h2>
			<p>
				Fokuset under veckan har legat i att skapa en gemenskap bland spelarna så att man på ett enkelt sätt kan kommunicera med varandra. För att lösa detta har vi tänkt att implementera en chatt, ett forum samt cykelklubbar. En cykelklubb är det som kan motsvaras i de flesta andra spel som Klan, Stam eller Gäng, ja ett kärt barn har många namn, men här kallas det "Cykelklubb".
			</p>
			<p>
				Ändrat sorteringsordern så att de mesta relevanta baxobjekten kommer i toppen på sidan
			</p>
			<p>
				Ändrat så att väntetidsfältet (cooldown) ligger kvar i toppen när man scrollar.
			</p>
			<p>
				Chattnotisen: den kommer att finnas där ifall man inte har läst chatten. Så snart man öppnar upp chatten så sätter den en status på chatten som läst för den befintliga användaren.<br />
				Tidigare fungeraden den som så att den lös upp 5minuter efter senaste aktivitet i chatten. Nu finns den alltså kvar tills dess att användaren läser chatten.
			</p>

			<h2>
				Förändringar i Baxobjekt, Garage, Marknader;
			</h2>
			<small>
				<h3>Baxobjekt</h3>
				<dl>
					<dt>Tant Kerstin</dt>
					<dd>Minskad väntetid från 20s till 10s</dd>

					<dt>Polski Cykelverkstad</dt>
					<dd>Minskad väntetid från 35s till 15s</dd>
					<dd>Minsta antalet cyklar ändrad från 3 till 2</dd>

					<dt>Hyrcyklar i Klofen</dt>
					<dd>Minskad väntetid från 45s till 20s</dd>
					<dd>Minsta antalet cyklar ändrad från 6 till 5</dd>
					<dd>Max antalet cyklar ändrad från 12 till 10</dd>

					<dt>MTB Shoppen</dt>
					<dd>Minskad väntetid från 60s till 25s</dd>
					<dd>Minsta antalet cyklar ändrad från 11 till 7</dd>
					<dd>Max antalet cyklar ändrad från 22 till 13</dd>

					<dt>Cadium Drottningsväng</dt>
					<dd>Minskad väntetid från 60s till 25s</dd>
					<dd>Minsta antalet cyklar ändrad från 25 till 10</dd>
					<dd>Max antalet cyklar ändrad från 50 till 18</dd>

					<dt><strong>NY NPC</strong> Kvarterets Mästare</dt>
					<dd>Väntetid: 35</dd>
					<dd>Min cyklar: 15</dd>
				    <dd>Max cyklar: 25</dd>
				    <dd>Levelkrav 15</dd>

				    <dt><strong>NY NPC</strong> Gunvalds cykelförråd</dt>
					<dd>Väntetid: 40</dd>
					<dd>Min cyklar: 20</dd>
				    <dd>Max cyklar: 30</dd>
				    <dd>Levelkrav 20</dd>

				    <dt><strong>NY NPC</strong> Nattklubben Foxlot</dt>
					<dd>Väntetid: 40</dd>
					<dd>Min cyklar: 25</dd>
				    <dd>Max cyklar: 40</dd>
				    <dd>Levelkrav 25</dd>

				    <dt><strong>NY NPC</strong> Cykelklubben Bikers</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 35</dd>
				    <dd>Max cyklar: 50</dd>
				    <dd>Levelkrav 30</dd>

				    <dt><strong>NY NPC</strong> ICAS parkering</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 47</dd>
				    <dd>Max cyklar: 65</dd>
				    <dd>Levelkrav 35</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 60</dd>
				    <dd>Max cyklar: 83</dd>
				    <dd>Levelkrav 40</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 80</dd>
				    <dd>Max cyklar: 108</dd>
				    <dd>Levelkrav 45</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 100</dd>
				    <dd>Max cyklar: 135</dd>
				    <dd>Levelkrav 50</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 130</dd>
				    <dd>Max cyklar: 170</dd>
				    <dd>Levelkrav 55</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 170</dd>
				    <dd>Max cyklar: 200</dd>
				    <dd>Levelkrav 60</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 205</dd>
				    <dd>Max cyklar: 250</dd>
				    <dd>Levelkrav 65</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 250</dd>
				    <dd>Max cyklar: 300</dd>
				    <dd>Levelkrav 70</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 310</dd>
				    <dd>Max cyklar: 365</dd>
				    <dd>Levelkrav 75</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 375</dd>
				    <dd>Max cyklar: 440</dd>
				    <dd>Levelkrav 80</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 450</dd>
				    <dd>Max cyklar: 525</dd>
				    <dd>Levelkrav 85</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 525</dd>
				    <dd>Max cyklar: 625</dd>
				    <dd>Levelkrav 90</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 625</dd>
				    <dd>Max cyklar: 750</dd>
				    <dd>Levelkrav 95</dd>

				    <dt><strong>NY NPC</strong> Saknar namn...</dt>
					<dd>Väntetid: 45</dd>
					<dd>Min cyklar: 750</dd>
				    <dd>Max cyklar: 35</dd>
				    <dd>Levelkrav 950</dd>
				</dl>

				<h3>Garage</h3>
				<dl>
					<dt>Farsans garage</dt>
						<dd>Storlek: 3</dd>
				        <dd>Pris: 0</dd>

					<dt>Skolans cykelställ</dt>
						<dd>Storlek: 10</dd>
				        <dd>Pris: 50000</dd>

					<dt>Idrottshallens gömda källare</dt>
						<dd>Storlek: 30</dd>
				        <dd>Pris: 125000</dd>

					<dt>Morfars gömdalagerlokal</dt>
						<dd>Storlek: 50</dd>
				        <dd>Pris: 350000</dd>
				                
					<dt>E4ans dike</dt>
						<dd>Storlek: 100</dd>
				        <dd>Pris: 750000</dd>

					<dt>Saknar namn...</dt>
						<dd>Storlek: 200</dd>
				        <dd>Pris: 1500000</dd>

					<dt>Saknar namn...</dt>
						<dd>Storlek: 500</dd>
				        <dd>Pris: 3000000</dd>

					<dt>Saknar namn...</dt>
						<dd>Storlek: 1750</dd>
				        <dd>Pris: 10000000</dd>

					<dt>Saknar namn...</dt>
						<dd>Storlek: 5000</dd>
				        <dd>Pris: 2500000</dd>
				</dl>

				<h3>Marknader</h3>
				<dl>
					<dt>Cykel Kjell</dt>
						<dd>Minsta antal cyklar: 1</dd>
						<dd>Max antal cyklar: 4</dt>
						<dd>Minsta pris: 250</dt>
						<dd>Max pris: 500</dd>

					<dt>Bikestore i Faksen</dt>
						<dd>Minsta antal cyklar: 4</dd>
						<dd>Max antal cyklar: 15</dt>
						<dd>Minsta pris: 450</dt>
						<dd>Max pris: 750</dd>

					<dt>Ender Spårt</dt>
						<dd>Minsta antal cyklar: 15</dd>
						<dd>Max antal cyklar: 35</dt>
						<dd>Minsta pris: 600</dt>
						<dd>Max pris: 900</dd>

					<dt>Hyrcykel Koteberg</dt>
						<dd>Minsta antal cyklar: 35</dd>
						<dd>Max antal cyklar: 65</dt>
						<dd>Minsta pris: 750</dt>
						<dd>Max pris: 1150</dd>

					<dt>Stanislav RU Export</dt>
						<dd>Minsta antal cyklar: 65</dd>
						<dd>Max antal cyklar: 100</dt>
						<dd>Minsta pris: 1000</dt>
						<dd>Max pris: 1500</dd>

					<dt>Cykelkungen</dt>
						<dd>Minsta antal cyklar: 100</dd>
						<dd>Max antal cyklar: 150</dt>
						<dd>Minsta pris: 1250</dt>
						<dd>Max pris: 1800</dd>

					<dt>Saknar namn...</dt>
						<dd>Minsta antal cyklar: 175</dd>
						<dd>Max antal cyklar: 350</dt>
						<dd>Minsta pris: 1500</dt>
						<dd>Max pris: 2100</dd>

					<dt>Saknar namn...</dt>
						<dd>Minsta antal cyklar: 350</dd>
						<dd>Max antal cyklar: 750</dt>
						<dd>Minsta pris: 2100</dt>
						<dd>Max pris: 3100</dd>

					<dt>Saknar namn...</dt>
						<dd>Minsta antal cyklar: 750</dd>
						<dd>Max antal cyklar: 1500</dt>
						<dd>Minsta pris: 2500</dt>
						<dd>Max pris: 3500</dd>

					<dt>Saknar namn...</dt>
						<dd>Minsta antal cyklar: 1500</dd>
		<dd>Max antal cyklar: 3500</dt>
		<dd>Minsta pris: 3000</dt>
		<dd>Max pris: 4250</dd>

	<dt>Saknar namn...</dt>
		<dd>Minsta antal cyklar: 3500</dd>
		<dd>Max antal cyklar: 5000</dt>
		<dd>Minsta pris: 4000</dt>
		<dd>Max pris: 5750</dd>
</dl>
			</small>
		</div>
	</div>

@stop