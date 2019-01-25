<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle', config('app.name'))</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body class="font-roboto w-full h-full bg-grey-lighter">
	<div class="wrapper" id="app">
		
		@yield('page')

	</div> {{-- end .wrapper --}}

    @yield('scripts')
</body>
</html>