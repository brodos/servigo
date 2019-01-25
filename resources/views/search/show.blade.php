@extends('layouts.app')
@section('pageTitle', $meta->pageTitle)

@section('mobile-top-navigation')

@endsection

@section('main-content')
<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

	<aside class="w-full lg:w-1/4 px-3 py-6 lg:px-0 lg:py-0 lg:pr-12 flex flex-col lg:block bg-indigo-dark lg:bg-grey-lighter sticky lg:relative pin-t lg:pin-none z-20 shadow-md lg:shadow-none">					
					
		<div class="hidden pb-6 font-bold uppercase text-sm text-indigo-darker opacity-50 lg:block">Filtrează anunțurile</div>

		<form action="{{ route('search.show') }}">
			<div class="w-full relative">
				<input name="q" type="search" class="w-full bg-grey-lightest appearance-none rounded text-sm text-blue-darker border p-4 pl-10 focus:bg-white focus:shadow-inner focus:outline-none" placeholder="Cauta..." value="{{ $q ?? '' }}">
				<span class="absolute pin-t pin-l text-grey pl-3 pt-4">
					<svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
				</span>
				<span class="lg:hidden absolute pin-t pin-r z-10 opacity-75 pr-3 pt-2">
					<a href="#" class="text-indigo-dark hover:text-indigo-darker">
						<svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
					</a>
				</span>
			</div>

			<div class="hidden lg:flex lg:flex-col justify-between">

				<div class="w-full relative mt-4 lg:mt-6">
					{{-- <input type="hidden" name="c" value="{{ $c ?? '' }}"> --}}
					<input name="c" type="text" class="w-full bg-grey-lightest appearance-none rounded text-blue-darker text-sm border p-4 pl-10  focus:bg-white focus:shadow-inner focus:outline-none" placeholder="Toate categoriile" value="{{ $c ?? '' }}">
					
					<span class="absolute pin-t pin-l pl-3 pt-4 text-grey">
						<svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M5 3h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg>
					</span>
					
				</div>

				<div class="w-full mt-4 lg:mt-6">
					<zone-selector :passed-counties="{{ $counties }}"></zone-selector>
				</div>

				<div class="relative mt-4 lg:mt-6 text-center lg:block">
					<button class="btn btn-grey-secondary bg-indigo-light border-indigo-light hover:bg-indigo-lightest text-white px-6 whitespace-no-wrap flex items-center">
						<svg class="fill-current w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
						<span>Caută</span>
					</button>
				</div>
			</div>

		</form>

		<div class="hidden">

			<div class="hidden pb-6 mt-12 font-bold uppercase text-sm text-blue-darker opacity-50 lg:block">Filtre cautare</div>

			<form>
				<div class="w-full relative">
					<input type="text" class="w-full bg-grey-lightest appearance-none rounded text-blue-darker text-sm  border p-4 focus:bg-white focus:shadow-inner focus:outline-none" placeholder="Alte filtre">
				</div>
			</form>

		</div>

	</aside>

	<main class="flex-1">
		
		<div class="card bg-white md:rounded md:shadow-lg">

			<div class="card-header p-6 border-b bg-grey-lightest flex items-center justify-between md:p-8 md:border-grey-lighter">
				
				<span class="text-xl font-semibold w-full leading-normal text-indigo-darker md:w-auto">Anunțuri</span>

				<span class="text-grey-dark flex flex-col-reverse items-center justify-center text-center cursor-pointer md:flex-row hover:text-indigo-dark" title="Salvează căutarea!">
					<span class="mt-2 md:mt-0 md:mr-2">Salveazã cãutarea</span>
					<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M6.1 21.98a1 1 0 0 1-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 0 1 .56-1.71l6.05-.88 2.7-5.48a1 1 0 0 1 1.8 0l2.7 5.48 6.06.88a1 1 0 0 1 .55 1.7l-4.38 4.27 1.04 6.03a1 1 0 0 1-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 0 1 .93 0l4.08 2.15-.78-4.55a1 1 0 0 1 .29-.88l3.3-3.22-4.56-.67a1 1 0 0 1-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 0 1-.75.54l-4.57.67 3.3 3.22a1 1 0 0 1 .3.88l-.79 4.55 4.09-2.15z"/></svg>
				</span>
				
			</div> <!-- end .card-header -->

			<div class="card-body">

				@each('partials.project', $projects, 'project', 'partials.no-project')

			</div>

			
			{{ $projects->appends(['q' => $q, 'c' => $c, 'z' => $z])->links() }}
			
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection