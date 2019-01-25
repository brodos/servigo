@extends('layouts.app')
@section('pageTitle', 'Contul meu')

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

		<div class="p-6 lg:p-0 lg:pb-8 flex justify-between">
			<span class="text-indigo-darker font-bold text-lg md:text-2xl">{{ $project->title }}</span>
		</div>
		
		<div class="card bg-white md:rounded md:shadow-lg">

			<div class="card-header p-6 md:px-10 border-b md:border-grey-light bg-grey-lightest flex items-center justify-between">
				<div class="flex items-center justify-between w-full">
					<span class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto">Oferte favorite</span>
					<div class="text-sm">
						<a href="{{ route('user-project-proposals.index', $project) }}" class="flex flex-col items-center text-indigo-dark no-underline">
							<svg class="fill-current w-6 h-6 md:w-8 md:h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m6.1,21.98a1,1 0 0 1 -1.45,-1.06l1.03,-6.03l-4.38,-4.26a1,1 0 0 1 0.56,-1.71l6.05,-0.88l2.7,-5.48a1,1 0 0 1 1.8,0l2.7,5.48l6.06,0.88a1,1 0 0 1 0.55,1.7l-4.38,4.27l1.04,6.03a1,1 0 0 1 -1.46,1.06l-5.4,-2.85l-5.42,2.85z"/></svg>
							<span class="mt-2 text-xs md:text-sm md:inline-block whitespace-no-wrap">doar favorite</span>
						</a>
					</div>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">

				@forelse($proposals as $proposal)

					<div class="content-item relative w-full relative flex items-start p-6 md:py-8 md:px-10 hover:bg-indigo-lightest 
						@if ($proposal->confirmed_at != null) border-l-4 border-green @elseif ($proposal->accepted_at != null) border-l-4 border-orange @elseif ($proposal->read_at == null) border-l-4 border-indigo-dark @else bg-grey-lightest @endif"
						>
							<div class="w-full">
								<div class="top">
									<div class="flex items-start justify-between w-full">
										<div class="person mr-4 flex items-center">
											<img class="w-10 h-10 rounded-full mr-3" src="{{ $proposal->owner->avatar() }}">
											<div class="flex flex-col">											
												<span class="text-base font-semibold md:text-lg no-underline text-green-dark hover:underline">{{ $proposal->owner->displayName }}</span>
												@if ($proposal->owner->profile->city_id)
													<span class="text-sm text-grey-dark mt-1">{{ $proposal->owner->profile->location }}</span>
												@endif
											</div>
											
										</div>
										
										<div>
											<span class="block whitespace-no-wrap font-bold text-lg md:text-2xl text-blue-darker leading-normal text-right">{{ number_format($proposal->price) }} lei</span>
											<span class="block whitespace-no-wrap text-sm md:text-lg text-grey-dark text-right">în {{ $proposal->duration . ' ' . config('settings.duration_type')[$proposal->duration_type] }}</span>
										</div>
									</div>
								</div>

								<div class="mt-4">
									<div class="flex-1 items-center justify-between text-grey-darkest leading-normal text-sm sm:text-base">
										<span class="font-bold">Mesaj:</span> {{ str_limit($proposal->description, 150) }}
									</div>

									@if ($proposal->confirmed_at != null) 
										<div class="mt-6 leading-normal">
											<span class="text-white bg-green font-bold text-sm px-6 py-2 rounded-full whitespace-no-wrap">Ofertă acceptată și  confirmată!</span>
										</div>
									@elseif ($proposal->accepted_at != null) 
										<div class="mt-6 leading-normal">
											<span class="text-white bg-orange font-bold text-sm px-6 py-2 rounded-full whitespace-no-wrap">Ofertă acceptată!</span>
										</div>
									@endif
								</div>

								<div class="mt-6 flex items-center md:items-end justify-between">
									<div class="flex items-center">
										<div class="text-xs sm:text-sm text-grey-dark flex items-center sm:w-auto mr-3">
											<span class="leading-none mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"></path></svg></span> 
											<span title="{{ $proposal->submitted_at->toFormattedDateString() }}" class="">{{ $proposal->submitted_at->diffForHumans() }}</span>
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
						
						<span class="text-lg md:text-2xl font-semibold text-grey-darkest">Nu ați adăugat nici-o ofertă la favorite.</span>
						
						<a class="btn btn-indigo leading-none flex items-center mt-8" href="{{ route('user-project-proposals.index', $project) }}">
							<span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-4 h-4 mr-2"><path d="M18 21H7a4 4 0 0 1-4-4V5c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v11a3 3 0 0 1-3 3zm-3-3V5H5v12c0 1.1.9 2 2 2h8.17a3 3 0 0 1-.17-1zm-7-3h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2zm9 11a1 1 0 0 0 2 0V7h-2v11z"></path></svg></span>
							<span>vezi toate ofertele</span>
						</a>

					</div>
				@endforelse

			</div>

			<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection