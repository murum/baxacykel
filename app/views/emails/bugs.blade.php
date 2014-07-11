<!doctype html>
<html lang="sv">
	<head>
		<title>Buggrapport från Baxacykel.se</title>
		<style type="text/css">
			body {
				font-family: 'Arial', sans-serif;
			}
			h2 {
				margin: 30px 0 6px 0;
			}

			p {
				margin: 0 0 12px 0;
			}
			.mail dt{
				font-weight: bold;
				display: inline;
			}
			.mail dd{
				margin: 0 0 12px 6px;
			}
		</style>
	</head>
	<body>
		<div class="mail">
			<dl>
				<dt>Användare</dt>
				<dd>{{ $username }}</dd>
				<dt>Sida</dt>
				<dd>{{ $page }}</dd>
				<dt>Prio</dt>
				<dd>{{ $prio }}</dd>
			</dl>
			<h2>Buggförklaring</h2>
			<p>
				{{ $msg }}
			</p>
		</div>

	</body>
</html>