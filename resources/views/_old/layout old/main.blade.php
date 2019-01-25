<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body class="font-sans w-full h-full">

    <div class="wrapper h-full flex w-full" id="app">

        <div class="flex flex-col xl:flex-row w-full mx-auto">

            <!-- LEFT & TOP -->
            <div class="left-top bg-blue w-full xl:w-64 xl:flex xl:flex-col">

               <div class="flex items-center justify-between p-4 xl:p-8">

                    <div class="menu-toggle xl:hidden">
                        <a href="#" class="text-grey-light hover:text-white no-underline leading-none ">
                            <svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/></svg>
                        </a>
                    </div>

                    <div class="logo flex-1 text-center">
                        <a href="#" class="inline-block no-underline font-semibold text-white leading-0 text-3xl">servigo</a>
                    </div>

                    <div class="user xl:hidden">
                        <a href="#" class="leading-none"><img class="rounded-full w-8 h-8" src="https://pbs.twimg.com/profile_images/964622868448497665/BroZY29N_400x400.jpg"></a>
                    </div>

                </div>

                <div class="menu hidden xl:block mb-6">

                    @include('layouts.main-nav') 

                </div>

                <div class="mt-auto p-8 hidden xl:block">
                    <span class="block text-sm flex flex-wrap leading-normal">
                        <a href="#privacy" class="inline-block  mr-2 text-blue-lightest opacity-75">Privacy</a>
                        <a href="#terms" class="inline-block   mr-2 text-blue-lightest opacity-75">Terms</a>
                        <a href="#advertising" class="inline-block   mr-2 text-blue-lightest opacity-75">Advertising</a>
                        <a href="#cookies" class="inline-block mr-2   text-blue-lightest opacity-75">Cookies</a>
                    </span>
                    <span class="block mt-4 text-sm text-blue-lightest">BDX Online SRL &copy; 2018</span>
                </div>   

            </div>
            <!-- END LEFT & TOP -->
            
            <!-- RIGHT & BOTTOM -->
            <div class="right-bottom bg-grey-lighter flex-1 w-full xl:w-auto">

                <div class="header hidden xl:flex items-center bg-grey-light">

                    <div class="form flex-1 justify-center">

                        <form>
                            
                            <div class="relative">
                                <input class="appearance-none block w-full bg-grey-light text-grey-darker py-3 leading-tight focus:outline-none px-16 py-6 border-b font-semibold" type="search" placeholder="Cauta" name="q">

                                <svg class="text-grey-dark mt-6 ml-6 fill-current w-6 h-6 absolute pin-t" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path  d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>

                                <button type="submit" class="hidden absolute pin-t pin-r mt-5 mr-5 bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline tracking-wide">CAUTA</button>
                            </div>

                        </form>

                    </div>

                    <div class="flex justify-center items-center h-100">

                        <a href="#" class="block text-grey-dark hover:text-blue-dark no-underline p-5 px-8 leading-none"style="line-height: 0">
                            <svg class="fill-current w-6 h-6 inline-block" style="line-height: 0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M15 19a3 3 0 0 1-6 0H4a1 1 0 0 1 0-2h1v-6a7 7 0 0 1 4.02-6.34 3 3 0 0 1 5.96 0A7 7 0 0 1 19 11v6h1a1 1 0 0 1 0 2h-5zm-4 0a1 1 0 0 0 2 0h-2zm0-12.9A5 5 0 0 0 7 11v6h10v-6a5 5 0 0 0-4-4.9V5a1 1 0 0 0-2 0v1.1z"/></svg>
                        </a>

                        <a href="#" class="flex justify-center items-center text-grey-darker hover:text-blue-dark no-underline py-5 pr-3">
                            <img class="rounded-full w-8 h-8 mr-3" src="https://pbs.twimg.com/profile_images/964622868448497665/BroZY29N_400x400.jpg">
                            <span class="font-semibold">Lucian B</span>
                            <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path  d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/></svg>
                        </a>

                    </div>

                </div><!-- end .header -->

                <main class="bg-grey-lighter">
            
                    @yield('page-nav')

                    @yield('main-content')

                </main>

            </div>
            <!-- RIGHT & BOTTOM -->

        </div>

        <flash-message message="{{ session('flash-message') }}"></flash-message>

    </div><!-- end .wrapper -->

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>