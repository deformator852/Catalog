<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	@vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
@yield('content')
<script>
	window.routes = {
		productsList: '{{ route('products.list') }}'
	}
</script>

</body>
</html>
