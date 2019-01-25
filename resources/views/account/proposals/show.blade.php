@extends('layouts.app')
@section('pageTitle', 'Oferta pentru ' . $proposal->project->title)

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => route('user-proposal.index')
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

			<div class="card-header p-6 md:px-10 border-b md:border-grey-lighter bg-grey-lightest flex items-center">

				<div class="back mr-8 hidden md:block">
					<a href="{{ route('user-proposal.index') }}" class="text-grey-darkest hover:text-blue no-underline">
						<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24"><path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/></svg>
					</a>
				</div>
				
				<div class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto mr-3">Detalii ofertă</div>

				<div class="hidden text-sm md:flex md:items-center sm:w-auto ml-auto">
					
					<a href="{{ route('project.show', $proposal->project) }}" class="btn btn-grey-secondary flex items-center leading-none">
						<span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M6 2h9a1 1 0 0 1 .7.3l4 4a1 1 0 0 1 .3.7v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm9 2.41V7h2.59L15 4.41zM18 9h-3a2 2 0 0 1-2-2V4H6v16h12V9zm-2 7a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm0-4a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm-5-4a1 1 0 0 1-1 1H9a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1z"/></svg></span> 
						<span>Vezi anunțul</span>
					</a>
					
				</div>
				
			</div> <!-- end .card-header -->

			<div class="card-body p-6 lg:p-10 text-grey-darkest">

				<div class="proposal-details">

					@if ($proposal->confirmed_at != null)
						<div class="mb-6 leading-normal md:mb-8 border-l-4 border-green bg-green-lightest p-6 lg:p-8 text-sm md:text-base" role="alert">
							<p class="font-semibold text-lg text-green-dark mb-4">Ofertă acceptată și confirmată!</p>

							<p class="text-green-dark mb-8">Felicitari! Oferta ta a fost castigătoarea anunțului.</p>
	
							<div>
								<a href="#" class="w-full md:w-auto inline-flex items-center justify-center btn btn-grey-secondary leading-none">
									<svg class="mr-2 fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"></path></svg>
									<span>Trimite mesaj</span>
								</a>
							</div>
							
						</div>
					@elseif ($proposal->accepted_at != null)
						<div class="mb-6 leading-normal md:mb-8 border-l-4 border-orange bg-orange-lightest p-6 lg:p-8 text-sm md:text-base" role="alert">
							<p class="font-semibold text-lg text-orange-dark mb-4">Ofertă acceptată!</p>
							<p class="text-orange-darker mb-4">Felicitari! Oferta ta a fost acceptată de către client. Te rugăm sa verifici termenii pe care i-ai propus și să confirmi oferta. Dacă sunt necesare clarificări din partea clientului, puteți lua legătura cu acesta folosind sistemul de mesagerie.</p>
							<p class="text-orange-darker mb-8">Daca totul este in ordine, poți confirma oferta, iar tu vei fi declarat câștigătorul acestui anunț.</p>
							<p class="text-orange-darker mb-8">În același timp, ai opțiunea de a retrage oferta făcută.</p>

							<div class="flex items-center flex-col-reverse md:flex-row justify-between">
								<div>
									<form action="{{ route('user-proposal.withdraw', $proposal) }}" method="post">
										@csrf
										@method('patch')
										<button type="submit" @click="confirmAction($event, 'Doriți să retrageți această ofertă?')" class="no-underline text-indigo-dark font-semibold hover:text-indigo-darker hover:underline">Retrage Oferta</button>
									</form>
								</div>
								<div class="flex items-center flex-col-reverse md:flex-row">
									<a href="#" class="flex w-full sm:w-auto mb-8 md:mb-0 items-center btn btn-grey-secondary md:mr-6 leading-none">
										<svg class="mr-2 fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"></path></svg>
										<span>Trimite mesaj</span>
									</a>

									<form action="{{ route('user-proposal.confirm', $proposal) }}" method="post">
										@csrf
										@method('patch')
										<button type="submit" @click="confirmAction($event, 'Doriți să confirmați această ofertă?')" class="flex w-full sm:w-auto mb-5 md:mb-0 items-center btn btn-green leading-none">
											<span><svg class="mr-2 fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.62 10H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H8.5c-1.2 0-2.3-.72-2.74-1.79l-3.5-7-.03-.06A3 3 0 0 1 5 9h5V4c0-1.1.9-2 2-2h1.62l4 8zM16 11.24L12.38 4H12v7H5a1 1 0 0 0-.93 1.36l3.5 7.02a1 1 0 0 0 .93.62H16v-8.76zm2 .76v8h2v-8h-2z"/></svg></span>
											<span>Confirmă oferta</span>
										</button>
									</form>
								</div>
							</div>
						</div>

					@elseif ($proposal->withdrawn_at != null)
						<div class="mb-6 leading-normal md:mb-8 border-l-4 border-red bg-red-lightest p-6 lg:p-8 text-sm md:text-base" role="alert">
							<p class="font-bold text-base md:text-lg text-red-dark mb-4">Ofertă retrasă!</p>

							<p class="text-red-dark">Oferta ta a fost retrasă la data de {{ $proposal->withdrawn_at->format('j F Y') }}.</p>
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

			</div> <!-- end .card-body -->

			<div class="card-footer bg-grey-lightest p-6 lg:px-10 border-t">
				
				<div class="text-right flex items-center justify-between lg:justify-end">
					<div>
						@can('withdraw_proposal', $proposal)
							<withdraw-proposal :proposal="{{ $proposal }}"></withdraw-proposal>
						@endcan
					</div>
					
					<div>
						@can('update_proposal', $proposal)
							<a href="{{ route('user-proposal.edit', $proposal) }}" class="btn btn-indigo inline-block ml-6">
								Modifică <span class="hidden sm:inline-block">oferta</span>
							</a>
						@endcan
					</div>
				</div>

			</div>
	
		</div> {{-- end .card --}}


		<div class="card bg-white mt-12 md:rounded md:shadow-lg">

			<div class="card-header p-6 md:px-10 border-b md:border-grey-lighter bg-grey-lightest flex items-center">
				
				<div class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto mr-3">Detalii anunț</div>
				
			</div> <!-- end .card-header -->

			<div class="card-body p-6 lg:py-8 lg:px-10 text-grey-darkest">

				<div class="project-details">

					<div class="flex itens-center justify-between w-full">
						<div class="text-sm mb-1 text-grey-dark flex items-center sm:w-auto mr-3">
							<span class="leading-none mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="3 -1 24 24" class="fill-current w-4 h-4 text-blue"><path d="M5 3h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg></span> 
							<span>Constructii / Amenajari</span>
						</div>
						<div class="text-sm text-grey-dark sm:w-auto md:flex md:items-center">
							<span class="leading-none mr-1 text-blue"><svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24"><path d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
							<span>{{ $proposal->project->owner->profile->location }}</span>
						</div>
					</div>

					<div class="project-title text-xl md:font-semibold leading-normal">
						<a href="{{ route('user-proposal.show', $proposal) }}" class=" z-20 text-green-dark hover:text-green-dark no-underline">
							{{ $proposal->project->title }}
						</a>
					</div>

					<div class="description mt-4">

						<span class="text-grey-darkest lg:text-lg leading-normal">
							{!! nl2br(str_limit(e($proposal->project->description), 200, '...')) !!} 
							<a href="{{ route('project.show', $proposal->project) }}" class="lg:hidden no-underline text-green-dark font-semibold">vezi anunțul</a>
						</span>

					</div>

					<div class="mt-8 flex flex-col sm:flex-row leading-normal">
						
						@if (! $proposal->project->start_date && ! $proposal->project->end_date)
							<span class="font-bold text-lg sm:text-xl mr-2 text-grey-darker">Perioada solicitată:</span>	
							<span class="text-lg sm:text-lg">cât mai curând</span>
						@elseif($proposal->project->start_date->diffInDays($proposal->project->end_date) > 0)
							<span class="font-bold text-lg sm:text-lg mr-2 text-grey-darker">Perioada solicitată:</span>	
							<span class="text-lg sm:text-lg">{{ $proposal->project->start_date->toFormattedDateString() }} - {{ $proposal->project->end_date->toFormattedDateString() }}</span>	
						@else
							<span class="font-bold text-lg sm:text-lg mr-2 text-grey-darker">Data solicitată:</span>	
							<span class="text-lg sm:text-lg">{{ $proposal->project->start_date->toFormattedDateString() }}</span>	
						@endif
						
					</div>

				</div> {{-- end .project-details --}}

				@if ($proposal->project->media->count() > 0)
					<hr class="my-10 h-px bg-grey-light">

					<div class="proposal-media">
						
						<h3>Fotografii atasate</h3>
			
						<ul class="list-reset flex items-center justify-start pt-4">
							@foreach ($proposal->project->media as $media)
								<li class="mr-2">
									<img src="{{ $media->asset_path }}" alt="{{ $proposal->project->title . ' ' . $loop->iteration }}" class="w-auto h-16 md:h-24">
								</li>
							@endforeach
						</ul>

					</div>
				@endif

			</div> <!-- end .card-body -->
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection