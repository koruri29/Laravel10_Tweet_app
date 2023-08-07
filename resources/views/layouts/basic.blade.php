<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{asset('/css/style.css')}}" >
	<title>@yield('page-title')</title>
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="header-left">
				<img src="{{asset('storage/tubuyaki.png')}}" alt="つぶやき">
			</div>
			<div class="header-right">
				<form action="{{route('logout')}}" method="post">
					@csrf
					<input class="btn" type="submit" value="ログアウト">
				</form>
			</div>
		</div>

	</header>
	<main class="main">
		<h1>つぶやき</h1>
		<h2>@yield('sub-title')</h2>
	
		<div class="content">
			@yield('content')
		</div>
	
	</main>
	<footer class="footer">
		&copy; Koruri Araki 2023
	</footer>
</body>
</html>
