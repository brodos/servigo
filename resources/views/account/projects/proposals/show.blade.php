@extends('layouts.app')
@section('pageTitle', 'Vizualizare oferta')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => str_contains(url()->previous(), '/oferte-favorite') ? route('user-project-favorites.index', $project) : route('user-project-proposals.index', $project)
	])
	@endcomponent
@endsection

@section('main-content')

<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row  lg:px-6">
	
	<aside class="w-full lg:w-1/4">
	
		@include('account.partials.project-menu')

	</aside>

	<main class="flex-1">

		<div class="py-8 lg:pt-0 flex justify-between">
			<span class="text-indigo-darker font-bold text-lg md:text-2xl">{{ $project->title }}</span>

			<div class="text-sm flex items-center sm:w-auto ml-3">
				<span class="leading-none mr-1 text-blue-dark"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M18 21H7a4 4 0 0 1-4-4V5c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v11a3 3 0 0 1-3 3zm-3-3V5H5v12c0 1.1.9 2 2 2h8.17a3 3 0 0 1-.17-1zm-7-3h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2zm9 11a1 1 0 0 0 2 0V7h-2v11z"/></svg></span> 
				<a href="{{ route('user-project-proposals.index', $project) }}" class="text-blue-dark no-underline hover:underline">Vezi toate ofertele</a>
			</div>
		</div>
		
		<div class="card bg-white md:rounded md:shadow-lg">

			<div class="card-header p-6 md:py-8 md:px-10 border-b md:border-grey-light bg-grey-lightest flex items-center justify-between">
				<div class="person flex items-center">
					<div class="back hidden md:block mr-8">
						<a href="{{ str_contains(url()->previous(), '/oferte-favorite') ? route('user-project-favorites.index', $project) : route('user-project-proposals.index', $project) }}" class="text-grey-darkest hover:text-blue no-underline">
							<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/></svg>
						</a>
					</div>
					<img class="w-10 h-10 rounded-full mr-4 shadow-inner md:w-12 md:h-12" src="{{ $proposal->owner->avatar() }}">
					<div class="flex-1 flex flex-col md:flex-row items-start">
						<div class="md:text-lg flex flex-col">											
							<a href="#" class="inline-block no-underline text-green-dark hover:underline font-semibold mr-2">{{ $proposal->owner->displayName }}</a>
							@if ($proposal->owner->profile->city_id)
								<span class=" text-sm text-grey-dark mt-1">{{ $proposal->owner->profile->location }}</span>
							@endif
						</div>
						{{-- <div class="mt-2 md:mt-0 flex items-center">
							<div class="mr-1">
								<span class="rating text-grey-dark">
									<span class="star">☆</span>
									<span class="star filled">☆</span>
									<span class="star filled">☆</span>
									<span class="star filled">☆</span>
									<span class="star filled">☆</span>
								</span>
							</div>
							<span class="text-sm text-grey-dark">(4 review-uri)</span>
						</div> --}}
					</div>
				</div>

				<div>
					@if($proposal->accepted_at === null && auth()->user()->can('toggle_accepted', $proposal))
						<form action="{{route('user-project-proposals.accept', [$proposal->project, $proposal])}}" method="post">
							@csrf
							@method('patch')
							<button @click="confirmAction($event, 'Doriți să acceptați această ofertă?')" class="btn btn-orange flex items-center leading-none" :class="{ 'disabled': isDisabled }">
								<svg class="fill-current w-6 h-6 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.62 10H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H8.5c-1.2 0-2.3-.72-2.74-1.79l-3.5-7-.03-.06A3 3 0 0 1 5 9h5V4c0-1.1.9-2 2-2h1.62l4 8zM16 11.24L12.38 4H12v7H5a1 1 0 0 0-.93 1.36l3.5 7.02a1 1 0 0 0 .93.62H16v-8.76zm2 .76v8h2v-8h-2z"/></svg>
								<span class="hidden md:ml-2 md:inline">Acceptă oferta</span>
							</button>
						</form>
					@endcan
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body p-6 lg:p-10 text-grey-darkest">

				<div class="proposal-details">

					@if ($proposal->confirmed_at != null)
						<div class="mb-6 leading-normal md:mb-8 border-l-4 border-green bg-green-lightest p-6 lg:p-8 text-sm md:text-base rounded" role="alert">
							<p class="font-semibold text-lg md:text-xl text-green-dark mb-4">Ofertă acceptată și confirmată!</p>

							<p class="text-green-darker mb-4">Aceasta este oferta acceptată de tine și confirmată de ofertant.</p>
							<p class="text-green-darker mb-4">Anunțul tău este marcat ca finalizat.</p>
							<p class="text-green-darker mb-8">Dacă nu ați facut-o deja, puteți lua legătura cu ofertantul folosind sistemul de mesagerie. De asemenea, datele de contact ale ofertantului sunt disponibile mai jos.</p>
	
							<div>
								<a href="{{ route('user-project-conversations.show', [$project, $proposal->conversation]) }}" class="w-full md:w-auto inline-flex items-center justify-center btn btn-grey-secondary leading-none">
									<svg class="mr-2 fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"></path></svg>
									<span>Trimite mesaj</span>
								</a>
							</div>
							
						</div>
					@elseif ($proposal->accepted_at != null)
						<div class="mb-6 leading-normal md:mb-8 border-l-4 border-orange bg-orange-lightest p-6 lg:p-8 text-sm md:text-base" role="alert">
							<p class="font-semibold text-lg md:text-xl text-orange-dark mb-4">Ofertă acceptată!</p>
							<p class="text-orange-darker mb-4">Felicitări pentru găsirea ofertei potrivite!</p>
							<p class="text-orange-darker mb-4">Ofertantul va fi notificat în cel mai scurt timp posibil. Acesta va trebui să reverifice oferta facută, iar apoi să o confirme sau să îți solicite informații suplimentare print sistemul de mesagerie. Și tu la randul tău poți contacta ofertantul prin sistemul de mesagerie.</p>
							<p class="text-orange-darker mb-8">Odată confirmată oferta, anuntul va fi marcat ca finalizat și datele de contact vor fi vizibile atât pentru tine cât și pentru ofertant.</p>
							<p class="text-orange-darker mb-8">Dacă ofertantul nu confirmă oferta în timp util, sau în cazul în care te răzgândești din orice motiv, ai posibilitatea de a <span class="font-semibold">anula acceptul</span> ofertei și să alegi o altă ofertă primită la anunțul tău.</p>

							<div class="flex items-center md:items-end flex-col-reverse md:flex-row justify-between">
								<div>
									@can('toggle_accepted', $proposal)
										<form action="{{route('user-project-proposals.unaccept', [$proposal->project, $proposal])}}" method="post">
											@csrf
											@method('delete')
											<button type="submit"  @click="confirmAction($event, 'Doriți să anulați acceptul pentru această ofertă?')" class="no-underline text-blue-dark text-sm md:text-base font-semibold hover:text-blue-darker">
												Anulează acceptul
											</button>
										</form>
									@endcan
								</div>
								<div class="flex items-center flex-col-reverse md:flex-row">
									<a href="{{ route('user-project-conversations.show', [$project, $proposal->conversation]) }}" class="flex w-full sm:w-auto mb-8 md:mb-0 items-center btn btn-grey-secondary leading-none">
										<svg class="mr-2 fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"></path></svg>
										<span>Trimite mesaj</span>
									</a>
								</div>
							</div>
						</div>

					@elseif ($proposal->withdrawn_at != null)
						<div class="mb-6 leading-normal md:mb-8 border-l-4 border-red bg-red-lightest p-6 lg:p-8 text-sm md:text-base" role="alert">
							<p class="font-semibold text-lg md:text-xl text-red-dark mb-4">Ofertă retrasă!</p>

							<p class="text-red-dark mb-4">Ne pare rău, dar ofertantul și-a retras oferta făcută.</p>
							<p class="text-red-dark mb-8">Nu te descuraja! Ai șansa să alegi o altă ofertă pentru anunțul tău.</p>
	
							<div>
								<a href="{{ route('user-project-proposals.index', $proposal->project) }}" class="w-full md:w-auto inline-flex items-center justify-center btn btn-grey-secondary leading-none">
									<svg class="mr-2 fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18 21H7a4 4 0 0 1-4-4V5c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v11a3 3 0 0 1-3 3zm-3-3V5H5v12c0 1.1.9 2 2 2h8.17a3 3 0 0 1-.17-1zm-7-3h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2zm9 11a1 1 0 0 0 2 0V7h-2v11z"></path></svg>
									<span>Vezi alte oferte</span>
								</a>
							</div>
						</div>
					@endif

					<div class="description leading-normal text-grey-darkest mb-8">
						{!! nl2br(e($proposal->description)) !!}
					</div>

					<h3>Termeni propuși</h3>

					<div class="proposal-meta py-6 lg:py-8 flex flex-col lg:flex-row lg:items-center lg:justify-around  leading-normal">

						<div class="available flex flex-col justify-center">
							<span class="text-2xl font-bold text-grey-darkest">{{ $proposal->available_from->format('d/m/Y') }}</span>
							<span class="text-sm font-bold uppercase text-grey">Disponibil</span>
						</div>

						<div class="available flex flex-col justify-center mt-4 lg:mt-0">
							<span class="text-2xl font-bold text-grey-darkest">{{ $proposal->duration . ' ' . config('settings.duration_type')[$proposal->duration_type] }}</span>
							<span class="text-sm font-bold uppercase text-grey">Execuție</span>
						</div>

						<div class="available flex flex-col justify-center mt-4 lg:mt-0">
							<span class="text-2xl font-bold text-grey-darkest">{{ number_format($proposal->price)}} lei</span>
							<span class="text-sm font-bold uppercase text-grey">Preț</span>
						</div>

					</div> <!-- end .proposal-meta -->

				</div>

				@if ($proposal->media->count() > 0)
					<hr class="my-10 h-px bg-grey-light">

					<div class="proposal-media">
						
						<h3>Fotografii atasate</h3>
			
						<ul class="list-reset flex items-center justify-start pt-4">
							@foreach ($proposal->media as $media)
								<li class="mr-2">
									<img src="{{ $media->asset_path }}" alt="{{ $proposal->project->title . ' ' . $loop->iteration }}" class="w-auto h-16 md:h-24">
								</li>
							@endforeach
						</ul>

					</div>
				@endif

			</div> {{-- end .card --}}

			<div class="card-footer bg-grey-lightest p-6 md:px-10 md:py-8 border-t flex items-center justify-between">
				<div class="flex items-center">
					<div class="text-xs sm:text-sm text-grey-dark flex items-center sm:w-auto mr-3">
						<span class="leading-none mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"></path></svg></span> 
						<span title="{{ $proposal->submitted_at->toFormattedDateString() }}" class="">{{ $proposal->submitted_at->diffForHumans() }}</span>
					</div>
					
					{{-- @if ($proposal->owner->profile->city_id)
						<div class="hidden text-sm text-grey-dark md:flex md:items-center sm:w-auto">
							<span class="leading-none mr-1"><svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24"><path d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
							<span>{{ $proposal->owner->profile->location }}</span>
						</div>
					@endif --}}
				</div>

				<div class="proposal-actions flex items-center z-10">
					@can('dismiss_proposal', $proposal)
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
						<span class="text-sm text-grey-dark mr-1 hidden">Adauga la favorite</span>
						<favorite :entity="{{ $proposal }}"></favorite>
					</div>
				</div>
			</div>
	
		</div> {{-- end .card --}}


		<div class="card bg-white md:rounded md:shadow-lg mt-16">
						
			<div class="card-header p-6 md:py-8 md:px-10 border-b bg-grey-lightest flex items-center justify-between">
				<span class="text-grey-dark font-bold text-lg md:text-xl leading-normal text-grey-darkest uppercase text-sm tracking-tight">Detalii ofertant</span>
			</div> <!-- end .card-header -->

			<div class="card-body">

				<div class="p-6 md:py-8 md:px-10 leading-normal">
					<div class="person flex-1 flex items-center">
						<img class="w-16 h-16 rounded-full mr-6" src="{{ $proposal->owner->avatar() }}">
						<div class="flex-1 flex flex-col items-start">
							<div class="text-xl flex items-center">											
								<a href="#" class="inline-block no-underline text-green-dark hover:underline font-semibold mr-2">{{ $proposal->owner->displayName }}</a>
							</div>

							@if ($proposal->owner->profile->city_id)
								<div class="mt-1 flex items-center">
									<span class="text-grey-dark font-bold">{{ $proposal->owner->profile->location }}</span>
								</div>
							@endif
						</div>
						<div class="member-since self-start">
							<span class="text-grey"><em>membru din<br>{{ $proposal->owner->created_at->format('F Y') }}</em></span>
						</div>
					</div>

					<div class="tagline mt-6">
						<span class="text-xl font-bold text-blue-darkest">{{ $proposal->owner->profile->tagline }}</span>
					</div>

					<div class="bio mt-4 leading-normal text-blue-darkest">
						{!! nl2br(e($proposal->owner->profile->bio)) !!}
					</div>

					<div class="profile-meta pt-12 pb-10 flex flex-col md:flex-row items-center justify-around">

						{{-- <div class="available flex flex-col justify-center">
							<div>
								<span class="rating text-grey-dark text-2xl">
									<span class="star">☆</span>
									<span class="star filled">☆</span>
									<span class="star filled">☆</span>
									<span class="star filled">☆</span>
									<span class="star filled">☆</span>
								</span>
							</div>										
							<span class="text-sm font-bold uppercase text-grey">Rating</span>
						</div> --}}
						
						{{-- <div class="available flex flex-col justify-center">
							<span class="text-2xl font-bold text-grey-darkest">12</span>
							<span class="text-sm font-bold uppercase text-grey">Calificative</span>
						</div> --}}

						{{-- <div class="available flex flex-col justify-center">
							<span class="text-2xl font-bold text-grey-darkest">9</span>
							<span class="text-sm font-bold uppercase text-grey">Review-uri</span>
						</div> --}}

						<div class="duration flex flex-col justify-center">
							<span class="text-2xl font-bold text-grey-darkest">14</span>
							<span class="text-sm font-bold uppercase text-grey">Anunturi Castigate</span>
						</div>

					</div> <!-- end .profile-meta -->
				</div>

			</div> <!-- end .card-body -->

		</div> <!-- and .card -->

		<div class="card bg-white md:rounded md:shadow-lg mt-16">
						
			<div class="card-header p-6 md:px-10 md:py-8 border-b bg-grey-lightest flex items-center justify-between">
				<span class="text-grey-dark font-bold text-lg md:text-xl leading-normal text-grey-darkest uppercase text-sm tracking-tight">Portofoliu</span>
				<!-- <span class="text-grey-dark"><em>trimisa acum 5 ore</em></span> -->
			</div> <!-- end .card-header -->

			<div class="card-body">

				<div class="album-portofoliu p-6 md:py-8 md:px-10 border-b">
					<span class="title text-grey-darker font-bold text-lg">Renovare baie</span>
					<div class="flex flex-wrap items-center mt-2">
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/640/480/arch?v=1"></span></a>
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/480/640/arch?v=2"></span></a>
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/640/480/arch?v=3"></span></a>
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/640/480/arch?v=4"></span></a>
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/640/480/arch?v=5"></span></a>
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/640/480/arch?v=6"></span></a>
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/640/480/arch?v=7"></span></a>
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/640/480/arch?v=8"></span></a>
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/640/480/arch?v=9"></span></a>
						<a href="#" class="w-1/5"><span class="inline-block p-2"><img class="h-32 w-auto mx-auto rounded shadow-md hover:shadow-lg" src="https://placeimg.com/640/480/arch?v=10"></span></a>

					</div>
				</div>

				<div class="album-portofoliu p-6 md:py-8 md:px-10">
					<span class="title text-grey-darker font-bold text-lg">Renovare baie</span>
					<div class="flex flex-wrap items-center mt-2">
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/640/480/arch?v=1"></a>
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/480/640/arch?v=2"></a>
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/640/480/arch?v=3"></a>
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/640/480/arch?v=4"></a>
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/640/480/arch?v=5"></a>
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/640/480/arch?v=6"></a>
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/640/480/arch?v=7"></a>
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/640/480/arch?v=8"></a>
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/640/480/arch?v=9"></a>
						<a href="#" class="mr-4 mb-4"><img class="rounded shadow-md hover:shadow-lg h-32 w-auto" src="https://placeimg.com/640/480/arch?v=10"></a>

					</div>
				</div>

			</div> <!-- end .card-body -->

			<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->

		</div> <!-- and .card -->

		<div class="card bg-white md:rounded md:shadow-lg mt-16">
						
			<div class="card-header p-6 md:py-8 md:px-10 border-b bg-grey-lightest flex items-center justify-between">
				<span class="text-grey-dark font-bold text-lg md:text-xl leading-normal text-grey-darkest uppercase text-sm tracking-tight">Istoric Anunturi castigate</span>
				<!-- <span class="text-grey-dark"><em>trimisa acum 5 ore</em></span> -->
			</div> <!-- end .card-header -->

			<div class="card-body">
					
				<div class="anunt flex border-b p-6 md:py-8 md:px-10">
					<div class="flex-1">
						<a href="#" class="font-bold no-underline hover:underline hover:text-blue text-lg text-blue-dark leading-normal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro.</a>
						<div class="calificativ flex items-center mt-4">
							<span class="rating text-grey-dark text-lg">
								<span class="star">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
							</span>
							<div class="ml-2 text-grey-dark">4.0</div>
						</div>
						<div class="review">
							<span class="text-grey-dark leading-normal text-sm"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro, ipsum atque fugit, voluptas saepe optio omnis aliquam!</em></span>
						</div>
					</div>
					<div class="ml-6"><span class="text-grey-dark">Dec 2018</span></div>
				</div> <!-- end .anunt -->

				<div class="anunt flex border-b p-6  md:py-8 md:px-10">
					<div class="flex-1">
						<a href="#" class="font-bold no-underline hover:underline hover:text-blue text-lg text-blue-dark leading-normal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro.</a>
						<div class="calificativ flex items-center mt-4">
							<span class="rating text-grey-dark text-lg">
								<span class="star">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
							</span>
							<div class="ml-2 text-grey-dark">4.0</div>
						</div>
						<div class="review">
							<span class="text-grey-dark leading-normal text-sm"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro, ipsum atque fugit, voluptas saepe optio omnis aliquam!</em></span>
						</div>
					</div>
					<div class="ml-6"><span class="text-grey-dark">Dec 2018</span></div>
				</div> <!-- end .anunt -->

				<div class="anunt flex border-b p-6  md:py-8 md:px-10">
					<div class="flex-1">
						<a href="#" class="font-bold no-underline hover:underline hover:text-blue text-lg text-blue-dark leading-normal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro.</a>
						<div class="calificativ flex items-center mt-4">
							<span class="rating text-grey-dark text-lg">
								<span class="star">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
							</span>
							<div class="ml-2 text-grey-dark">4.0</div>
						</div>
						<div class="review">
							<span class="text-grey-dark leading-normal text-sm"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro, ipsum atque fugit, voluptas saepe optio omnis aliquam!</em></span>
						</div>
					</div>
					<div class="ml-6"><span class="text-grey-dark">Dec 2018</span></div>
				</div> <!-- end .anunt -->

				<div class="anunt flex border-b p-6  md:py-8 md:px-10">
					<div class="flex-1">
						<a href="#" class="font-bold no-underline hover:underline hover:text-blue text-lg text-blue-dark leading-normal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro.</a>
						<div class="calificativ flex items-center mt-4">
							<span class="rating text-grey-dark text-lg">
								<span class="star">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
							</span>
							<div class="ml-2 text-grey-dark">4.0</div>
						</div>
						<div class="review">
							<span class="text-grey-dark leading-normal text-sm"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro, ipsum atque fugit, voluptas saepe optio omnis aliquam!</em></span>
						</div>
					</div>
					<div class="ml-6"><span class="text-grey-dark">Dec 2018</span></div>
				</div> <!-- end .anunt -->

				<div class="anunt flex p-6  md:py-8 md:px-10">
					<div class="flex-1">
						<a href="#" class="font-bold no-underline hover:underline hover:text-blue text-lg text-blue-dark leading-normal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro.</a>
						<div class="calificativ flex items-center mt-4">
							<span class="rating text-grey-dark text-lg">
								<span class="star">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
								<span class="star filled">☆</span>
							</span>
							<div class="ml-2 text-grey-dark">4.0</div>
						</div>
						<div class="review">
							<span class="text-grey-dark leading-normal text-sm"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem quisquam dolorum expedita recusandae at earum amet maiores illum deleniti eligendi accusamus porro, ipsum atque fugit, voluptas saepe optio omnis aliquam!</em></span>
						</div>
					</div>
					<div class="ml-6"><span class="text-grey-dark">Dec 2018</span></div>
				</div> <!-- end .anunt -->
				

			</div> <!-- end .card-body -->

			<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->

		</div> <!-- and .card -->


		

	</main>

</div>
@endsection