@extends('layouts.app')
@section('pageTitle', 'Oferele mele')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => route('user-project.index'),
	])
	@endcomponent
@endsection

@section('main-content')

<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

	<aside class="w-full lg:w-1/4">					
			
		@include('account.partials.account-menu')

	</aside>

	<main class="flex-1">
		
		<div class="card bg-white md:rounded md:shadow-lg">

			<div class="card-header p-6 lg:py-8 lg:px-10 border-b md:border-grey-lighter bg-grey-lightest flex items-center justify-between shadow-inner">
				<div class="flex flex-col">
					<span class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto">Ofertele mele</span>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">
			
				@forelse($proposals as $proposal)
					<div class="content-item relative w-full p-6 md:py-8 md:px-10 hover:bg-grey-lightest @if ($proposal->confirmed_at != null) border-l-4 border-green @elseif ($proposal->accepted_at != null) border-l-4 border-orange @elseif($proposal->withdrawn_at != null) bg-grey-lightest border-l-4 border-grey opacity-75 @else border-l-4 border-transparent @endif">
						<div class="w-full">

							<div class="top text-xs text-grey-dark sm:text-sm flex itens-center w-full justify-between mb-2 lg:mb-1">
								<div class="flex items-center sm:w-auto mr-3">
									<span class="leading-none mr-1"><svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="3 -1 24 24"><path d="M5 3h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg></span> 
									<span>Constructii / Amenajari</span>
								</div>
									
								<div class="flex items-center sm:w-auto">
									<span class="leading-none mr-1"><svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24"><path d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
									<span>{{ $proposal->project->owner->profile->location }}</span>
								</div>
							</div>
							
							<div class="project-title">
								<a href="{{ route('user-proposal.show', $proposal) }}" class="font-semibold text-lg sm:text-xl leading-normal z-10 text-black hover:text-green-dark no-underline">
									{{ $proposal->project->title }}
								</a>
							</div>

							

							<div class="mt-6">
								<div class="text-grey-darkest leading-normal text-sm sm:text-base">
									{{ str_limit($proposal->description, 150) }}
								</div>

								@if ($proposal->confirmed_at != null) 
									<div class="mt-6">
										<span class="inline-block text-green-dark bg-green-lightest border border-green-lighter font-semibold text-sm px-6 py-2 rounded-full whitespace-no-wrap">Ofertă acceptată și confirmată!</span>
									</div>
								@elseif ($proposal->accepted_at != null) 
									<div class="mt-6">
										<span class="inline-block text-orange-dark bg-orange-lightest border border-orange-lighter font-semibold text-sm px-6 py-2 rounded-full whitespace-no-wrap">Ofertă acceptată!</span>
									</div>
								@elseif ($proposal->withdrawn_at != null) 
									<div class="mt-6">
										<span class="inline-block text-grey-darkest bg-grey-light border border-grey font-semibold text-sm px-6 py-2 rounded-full whitespace-no-wrap">Ofertă retrasă!</span>
									</div>
								@endif
							</div>

							<div class="mt-6 flex items-center lg:items-end justify-between">
								<div class="text-xs sm:text-sm text-grey-dark flex items-center sm:w-auto mr-3">
									<span class="leading-none mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"></path></svg></span> 
									<span title="{{ $proposal->submitted_at->toFormattedDateString() }}" class="">{{ $proposal->submitted_at->diffForHumans() }}</span>
								</div>
								
								<div>
									<span class="block font-bold text-xl md:text-2xl text-grey-darkest leading-normal text-right">{{ number_format($proposal->price) }} lei</span>
									{{-- <span class="block text-sm md:text-lg text-grey-dark text-right">în {{ $proposal->duration . ' ' . config('settings.duration_type')[$proposal->duration_type] }}</span> --}}
								</div>
							</div>
						</div>

						<a href="{{ route('user-proposal.show', $proposal) }}" class="absolute pin-t pin-r w-full h-full"></a>
					</div>

					<div class="h-px bg-grey-light"></div>
	
				@empty

					<div class="flex flex-col items-center justify-center px-6 py-10">
						<span class="text-lg md:text-2xl font-semibold text-grey-darkest">Nu ați trimis nici-o ofertă.</span>

						<a href="{{ route('search.show') }}" class="mt-10 btn btn-indigo">Caută anunțuri</a>
					</div>

				@endforelse

			</div>

			{{ $proposals->links() }}
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection