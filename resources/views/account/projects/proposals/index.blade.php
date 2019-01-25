@extends('layouts.app')
@section('pageTitle', 'Oferte primite')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => route('user-project.index')
	])
	@endcomponent
@endsection

@section('main-content')

<div class="content container mx-auto lg:px-6">

	{{-- <div class="holla flex pt-6">
		<div class="w-full lg:w-1/4 hidden lg:block">
			<div class="container mx-auto hidden lg:pb-8 lg:block">
				<a href="http://servigo.test/contul-meu/anunturi" class="btn btn-link text-indigo-dark pl-0 pt-0 mt-0 inline-flex items-center">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-4 h-4 mr-2"><path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"></path></svg> 
					<span>Anunțurile mele</span></a>
			</div>
		</div>

		<div class="p-6 md:p-0 md:pb-8 flex-1">
			<span class="text-indigo-darker font-bold text-lg md:text-2xl">{{ $project->title }}</span>
		</div>
	</div> --}}
	
	<div class="w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

		<aside class="w-full lg:w-96">
		
			@include('account.partials.project-menu')

		</aside>

		<main class="flex-1">

			<div class="p-6 md:p-0 md:pb-8 flex justify-between">
				<span class="text-indigo-darker font-bold text-lg md:text-2xl">{{ $project->title }}</span>
			</div>
			
			<div class="card bg-white md:rounded-lg md:shadow-lg">

				<div class="card-header p-6 md:px-10 border-b md:border-grey-light bg-grey-lightest shadow-inner">
					<div class="flex items-center justify-between w-full">
						<span class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto">Oferte primite</span>
						<div class="text-sm">
							<a href="{{ route('user-project-favorites.index', $project) }}" class="flex flex-col items-center text-grey-dark no-underline hover:text-indigo-dark">
								<svg class="fill-current w-6 h-6 md:w-8 md:h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.1 21.98a1 1 0 0 1-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 0 1 .56-1.71l6.05-.88 2.7-5.48a1 1 0 0 1 1.8 0l2.7 5.48 6.06.88a1 1 0 0 1 .55 1.7l-4.38 4.27 1.04 6.03a1 1 0 0 1-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 0 1 .93 0l4.08 2.15-.78-4.55a1 1 0 0 1 .29-.88l3.3-3.22-4.56-.67a1 1 0 0 1-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 0 1-.75.54l-4.57.67 3.3 3.22a1 1 0 0 1 .3.88l-.79 4.55 4.09-2.15z"/></svg>
								<span class="mt-2 text-xs md:text-sm md:inline-block whitespace-no-wrap">doar favorite</span>
							</a>
						</div>
					</div>
				</div> <!-- end .card-header -->

				<div class="card-body">

					@forelse($proposals as $proposal)

						<div class="content-item relative w-full relative flex items-start p-6 md:py-8 md:px-10 hover:bg-grey-lightest 
							@if ($proposal->confirmed_at != null) 
								border-l-4 border-green 
							@elseif ($proposal->accepted_at != null) 
								border-l-4 border-orange 
							@elseif ($proposal->read_at == null) 
								border-l-4 border-indigo-lighter
							@else 
								bg-grey-lightest border-l-4 border-transparent
							@endif"
						>
							<div class="w-full">
								<div class="top">
									<div class="flex items-start justify-between w-full">
										<div class="person mr-4 flex items-center">
											<img class="w-10 h-10 rounded-full mr-4 shadow-inner" src="{{ $proposal->owner->avatar() }}">
											<div class="flex flex-col">											
												<span class="font-semibold md:text-lg no-underline text-green-dark hover:underline">{{ $proposal->owner->displayName }}</span>
												@if ($proposal->owner->profile->city_id)
													<span class="text-sm text-grey-dark mt-1">{{ $proposal->owner->profile->location }}</span>
												@endif
											</div>
											
										</div>
										
										<div>
											<span class="block whitespace-no-wrap font-bold text-lg md:text-2xl text-blue-darker leading-normal text-right">{{ number_format($proposal->price) }} lei</span>
											{{-- <span class="block whitespace-no-wrap text-sm md:text-lg text-grey-dark text-right">în {{ $proposal->duration . ' ' . config('settings.duration_type')[$proposal->duration_type] }}</span> --}}
										</div>
									</div>
								</div>

								<div class="mt-4">
									<div class="text-grey-darkest leading-normal text-sm sm:text-base">
										{{ str_limit($proposal->description, 150) }}
									</div>

									@if ($proposal->confirmed_at != null) 
										<div class="mt-4">
											<span class="inline-block text-green-dark bg-green-lightest border border-green-lighter font-semibold text-sm px-6 py-2 rounded-full whitespace-no-wrap">Ofertă acceptată și  confirmată!</span>
										</div>
									@elseif ($proposal->accepted_at != null) 
										<div class="mt-4">
											<span class="inline-block 	text-orange-dark border border-orange-lighter bg-orange-lightest font-semibold text-sm px-6 py-2 rounded-full whitespace-no-wrap">Ofertă acceptată!</span>
										</div>
									@endif
								</div>

								<div class="mt-4 flex items-center md:items-end justify-between">
									<div class="flex items-center z-10">
										<div class="text-xs sm:text-sm text-grey-dark flex items-center sm:w-auto mr-3" title="{{ $proposal->submitted_at->toFormattedDateString() }}">
											<span class="leading-none mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"></path></svg></span> 
											<span class="">{{ $proposal->submitted_at->diffForHumans() }}</span>
										</div>
										
										{{-- @if ($proposal->owner->profile->city_id)
											<div class="hidden text-sm text-grey-dark md:flex md:items-center sm:w-auto">
												<span class="leading-none mr-1"><svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24"><path d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
												<span>{{ $proposal->owner->profile->location }}</span>
											</div>
										@endif --}}
									</div>

									<div class="flex items-center z-10">
										@can ('dismiss_proposal', $proposal)
											<div class="mr-4">
												<span class="text-sm text-grey-dark mr-1 hidden">Ascunte oferta</span>
												<dismiss-proposal :proposal="{{ $proposal }}"></dismiss-proposal>
											</div>
										@endcan

										<div class="mr-4">
											<span class="text-sm text-grey-dark mr-1 hidden">Trimite mesaj</span>
											<a href="{{ $proposal->conversation ? route('user-conversation.show', $proposal->conversation) : route('user-conversation.store', [$project->uuid, $proposal->uuid]) }}" class="no-underline px-2 py-2">
												<span class="{{ $proposal->conversation && $proposal->conversation->messages->count() > 0 ? 'text-green' : 'text-grey-dark' }} hover:text-indigo-dark cursor-pointer" title="Trimite mesaj">
													<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/></svg>
												</span>
											</a>
										</div>

										<div>
											<span class="text-sm text-grey-dark mr-1 hidden">Adaugă la favorite</span>
											<favorite :entity="{{ $proposal }}"></favorite>
										</div>
									</div>
								</div>
							</div>

							<a href="{{ route('user-project-proposals.show', [$project, $proposal]) }}" class="absolute pin-t pin-r w-full h-full"></a>
						</div>

						<div class="h-px bg-grey-light"></div>

					@empty

						<div class="flex flex-col items-center justify-center px-6 py-10">
							<span class="text-lg md:text-2xl font-semibold text-grey-darkest">Încă nu s-au primit oferte pentru acest anunț.</span>
							<p class="mt-4 text-grey-dark text-lg">Promovați!.</p>
						</div>

					@endforelse

				</div>

				<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->
		
			</div> {{-- end .card --}}

		</main>
	</div>
</div>
@endsection