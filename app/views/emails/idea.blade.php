<!doctype html>
<html lang="sv">
	<head>
		<title>Idé ifrån Baxacykel.se</title>
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
			<h2>{{ $idea }} ifrån {{ $username }}</h2>
			<p>
				{{ $msg }}
			</p>
		</div>

	</body>
</html>