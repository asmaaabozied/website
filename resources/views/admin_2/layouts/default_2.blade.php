<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ env('APP_TITLE') }}</title>
	<link rel="stylesheet" href="{{ url('assets/css/admin_2/skeleton.min.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/admin_2/style.css') }}">
</head>
<body>
	<div class="container">
		<header>
			<h1>{{ env('APP_TITLE') }}</h1>
		</header>
		
		<li><a href="/dashboard">Dashboard</a></li>
		<li><a href="/logout">Logout</a></li>
		
		@include('admin_2.partials.alert')
		@yield('content')
	</div>
</body>
</html>