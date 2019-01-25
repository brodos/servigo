<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="h-100">
    <div id="app" class="d-flex flex-column h-100">
        <header class="mb-4">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Top Navbar -->
                        <ul class="navbar-nav mr-auto">
                            @can('client')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('client-projects.index') }}">Link</a>
                                </li>
                            @elsecan('contractor')

                            @endcan
                        </ul>


                        
                        <!-- Right Side Of Top Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                                </li>
                                <li class="nav-item">
                                    @if (Route::has('register'))
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                                    @endif
                                </li>
                            @else
                                <li class="nav-item"><a href="#" class="nav-link">{{ auth()->user()->displayRoles() }}</a></li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('auth.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <nav class="bg-white border-bottom">

                <div class="container d-flex">
                    
                    <!-- Left Side Of Second Navbar -->
                    <ul class="nav mr-auto">
                        @can('client')
                            <li class="nav-item">
                                <a class="nav-link py-3" href="{{ route('client-projects.index') }}">Proiecte active</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3" href="{{ route('client-draft-projects.index') }}">Ciorne</a>
                            </li>
                        @elsecan('contractor')
                            <li class="nav-item">
                                <a class="nav-link py-3" href="{{ route('contractor-search-projects.show') }}">Caute proiecte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3" href="#">Proiecte salvate</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3" href="{{ route('contractor-ongoing-projects.index') }}">Proiecte in desfasurare</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3" href="{{ route('contractor-completed-projects.index') }}">Proiecte finalizate</a>
                            </li>
                        @endcan
                    </ul>   
                        
                    <!-- Right Side Of Second Navbar -->
                    <ul class="nav justify-content-center">
                        @can('contractor')
                            <li class="nav-item">
                                <a class="nav-link py-3" href="{{ route('contractor-proposals.index') }}">Oferte trimise</a>
                            </li>
                        @endcan
                        
                        @yield('second-nav')
                    </ul>
                
                </div>

            </nav>

        </header>

        <main class="mb-auto">

            <div class="container">
                <div class="row">
        
                    @yield('left-sidebar')

                    <div class="col">

                        @yield('content')

                    </div>

                    @yield('right-sidebar')

                </div>
            </div>
        </main>

        <footer class="mt-auto p-5 mt-5 bg-dark">
            
            <div class="m-5  text-center text-light">Some footer here</div>

        </footer>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
