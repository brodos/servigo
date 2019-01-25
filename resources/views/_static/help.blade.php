@extends('layouts.app')
@section('pageTitle', 'Ajutor')

@section('mobile-top-navigation')
<a href="#" class="text-grey-darker">
	<svg class="hidden fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
	<svg class="hidden fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"></path></svg>
	<svg class=" fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M13 20v-5h-2v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-7.59l-.3.3a1 1 0 1 1-1.4-1.42l9-9a1 1 0 0 1 1.4 0l9 9a1 1 0 0 1-1.4 1.42l-.3-.3V20a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2zm5 0v-9.59l-6-6-6 6V20h3v-5c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v5h3z"/></svg>
</a>
@endsection

@section('main-content')
<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

	<aside class="w-full lg:w-1/4">					
					
		<div class="hidden pb-4 pl-6 font-bold uppercase text-sm text-blue-darker opacity-50 lg:block">Ajutor</div>

		<ul class="list-reset flex flex-row justify-between lg:mb-10 lg:flex-col">
			
			{{-- @include('account.partials.menu') --}}

		</ul>

	</aside>

	<main class="flex-1">
		
		<div class="card bg-white md:rounded md:shadow-lg">

			<div class="card-header p-6 md:p-8 border-b md:border-grey-lighter bg-grey-lightest flex items-center justify-between">
				<div class="flex flex-col">
					<span class="text-grey-dark font-bold text-lg md:text-xl leading-normal text-grey-darkest uppercase text-sm tracking-tight">Ajutor</span>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">

			</div>

			<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection