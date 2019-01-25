@extends('layouts.skeleton')

@section('page')
<nav class="header bg-white sticky pin-t z-20 shadow lg:pin-none lg:shadow-none lg:relative">
	@unless(Request::is(['/']))
		<div class="h-1 bg-indigo-dark md:h-2"></div>	
	@endunless

	<div class="container mx-auto flex items-center justify-between px-6 py-4 sm:py-6 @if (Request::is(['/'])) lg:py-10 @else lg:py-8 @endif">

		@section('mobile-top')
			<div class="navigation w-1/4 lg:hidden ">
				
				@yield('mobile-top-navigation')
				
			</div>
		@show
	
		<div class="logo @if (Request::is(['/'])) w-full @else w-1/2 @endif lg:w-auto flex items-center justify-center lg:justify-start">
			<a href="{{ route('home') }}" class="no-underline text-indigo-darker text-4xl mb-1 tracking-tight sm:mb-0">
				servigo
			</a>
		</div>

		@section('top-bar')

			<div class="top-nav flex items-center justify-end w-1/4 lg:w-auto">
					
				<div class="hidden lg:block links">
								
					<ul class="list-reset flex items-center justify-between md:justify-end">

						<li>
							<a href="{{ route('search.show') }}" class="no-underline text-grey-darker hover:text-indigo-dark pr-0 flex items-center{{ Request::is(['/cauta*']) ? ' text-indigo-dark' : '' }}">
								<span><svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg></span>
								<span>Caută anunțuri</span>
							</a>
						</li>

						{{-- <li>
							<a href="{{ route('user-projects.index') }}" class="ml-10 no-underline text-grey-darker hover:text-indigo-dark pr-0 flex items-center{{ Request::is([str_replace_first('/', '', route('user-account.show', [], false)) . '*']) ? ' text-indigo-dark' : '' }}">
								<span><svg class="fill-current w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"></path></svg></span>
								<span>Contul meu</span>
							</a>
						</li> --}}

						<li>
							<a href="{{ route('user-project.index') }}" class="btn btn-grey-secondary px-2 ml-10 sm:px-6 leading-none flex items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-4 h-4 mr-2"><path d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"></path></svg>
								<span>Contul meu</span>
							</a>
						</li>

						{{-- <li>
							<a href="{{ route('user-project.create') }}" class="btn btn-green px-2 ml-10 sm:px-6">
								Adaugă anunț
							</a>
						</li> --}}

					</ul>

				</div>
					
				@if(! Request::is(['/']) && auth()->check())

					<div class="user flex items-center lg:pl-6 lg:ml-6 lg:border-l">
						<div class="image sm:mr-3">
							<a href="{{route('user-project.index') }}">
								<img src="{{ auth()->user()->avatar() }}" class="rounded-full w-8 h-8">
							</a>
						</div>
						<div class="meta hidden sm:flex flex-col justify-between text-sm font-bold leading-tight text-grey-darkest">
							<span>{{ auth()->user()->displayName }}</span>
							<span><a href="{{ route('logout') }}" class="no-underline text-blue-dark hover:underline hover:text-blue-darker">Ieșire</a></span>
						</div>
					</div>

				@endif

			</div>

		@show

	</div>

</nav>

@yield('main-content')

<footer class="footer container mx-auto flex items-center justify-between my-10 px-3 pb-16 lg:px-2 lg:pb-0">
		
	<span class="text-sm text-grey-dark whitespace-no-wrap"><span class="hidden">BDX Online SRL</span> &copy; 2018</span>

	<ul class="list-reset text-sm flex flex-wrap leading-normal ml-6 justify-end">
		<li><a href="#gdpr" class="ml-4 text-blue-dark hover:text-blue-darker opacity-75">GDPR</a></li>
		<li><a href="#privacy" class="ml-4 text-blue-dark hover:text-blue-darker opacity-75 whitespace-no-wrap">Politica de confidențialitate</a></li>
		<li><a href="#terms" class="ml-4 text-blue-dark hover:text-blue-darker opacity-75 whitespace-no-wrap">Termeni și condiții</a></li>
		<li><a href="#advertising" class="ml-4 text-blue-dark hover:text-blue-darker opacity-75">Promovare</a></li>
		<li><a href="#cookies" class="ml-4 text-blue-dark hover:text-blue-darker opacity-75">Cookies</a></li>
		<li><a href="#anpc" class="ml-4 text-blue-dark hover:text-blue-darker opacity-75">ANPC</a></li>
	</ul>

</footer>

<div class="flash-container z-50 fixed pin-b pin-l mb-20 mr-8">
	<flash-message message="{{ session('flash-message') }}"></flash-message>
</div>
@endsection

@section('scripts')
	<script src="{{ mix('/js/app.js') }}"></script>
@endsection