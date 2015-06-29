<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	 {{ HTML::style('style.css') }}
	<title>BAZE 2 App</title>
</head>
@yield('body')
	<div class="container">
		<div class="well">
			<h1>DB App</h1>
			<h3><i>- dekompozicija relacijske sheme u 3. normalnu formu -</i></h3>
		</div>

	<ul class="nav nav-tabs">
  <li><a href="/">Home</a></li>
</ul>
	@yield('content')
	</div>
	<footer class="footer">
		<a href="http://vfdesign.org" target="_blank">VFdesign.org</a>
	</footer>
</body>
</html>
