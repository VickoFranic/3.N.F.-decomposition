<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	 {{ HTML::style('style.css') }}
	<title>BAZE 2 App</title>
</head>
<body>
	<div class="container">
	<h1 class="well text-center">DB App</h1>
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
