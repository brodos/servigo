@extends('layouts.app')
@section('pageTitle', 'Promovare anunt')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => route('user-project.index')
	])
	@endcomponent
@endsection

@section('main-content')

<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

	<aside class="w-full lg:w-1/4">
	
		@include('account.partials.project-menu')

	</aside>

	<main class="flex-1">

		<div class="p-6 md:p-0 md:pb-8 flex justify-between">
			<span class="text-indigo-darker font-bold text-lg md:text-2xl">{{ $project->title }}</span>
		</div>
		
		<div class="card bg-white md:rounded md:shadow-lg">

			<div class="card-header p-6 md:py-8 md:px-10 border-b md:border-grey-lighter bg-grey-lightest flex items-center justify-between">
				<div class="flex flex-col">
					<span class="text-xl font-semibold md:text-2xl leading-normal text-grey-dark">Promovare anunț</span>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">

				<div class="p-6 md:py-8 md:px-10">Promovare</div>

			</div>

			<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection