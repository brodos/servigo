@extends('layouts.app')
@section('pageTitle', 'Modifica oferta pentru ' . $proposal->project->title)

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => route('user-proposal.show', $proposal)
	])
	@endcomponent
@endsection

@section('main-content')

<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

	<aside class="w-full lg:w-1/4">					
			
		@include('account.partials.account-menu')

	</aside>

	<main class="flex-1">

		<form method="post" action="{{ route('user-proposal.update', $proposal) }}" enctype="multipart/form-data">
			@csrf
			@method('put')
		
			<div class="card bg-white md:rounded md:shadow-lg">

				<div class="card-header p-6 md:px-10 border-b md:border-grey-lighter bg-grey-lightest flex items-center">

					<div class="back mr-8 hidden md:block">
						<a href="{{ route('user-proposal.show', $proposal) }}" class="text-grey-darkest hover:text-blue no-underline">
							<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24"><path class="heroicon-ui" d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/></svg>
						</a>
					</div>
					
					<div class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto mr-3">Modifică oferta</div>

					<div class="hidden text-sm md:flex md:items-center sm:w-auto ml-auto">
						
						<a href="{{ route('project.show', $proposal->project) }}" class="btn btn-grey-secondary flex items-center leading-none">
							<span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M6 2h9a1 1 0 0 1 .7.3l4 4a1 1 0 0 1 .3.7v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm9 2.41V7h2.59L15 4.41zM18 9h-3a2 2 0 0 1-2-2V4H6v16h12V9zm-2 7a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm0-4a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm-5-4a1 1 0 0 1-1 1H9a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1z"/></svg></span> 
							<span>Vezi anunțul</span>
						</a>
						
					</div>
					
				</div> <!-- end .card-header -->

				<div class="card-body p-3 sm:p-6 lg:py-8 lg:px-10 text-grey-darkest">

					@if($errors->isNotEmpty())
				
						<div class="text-red text-sm p-8 mb-10 bg-red-lightest font-semibold">Formularul are niște erori.</div>

					@endif

					<div class="project-details">

						<div>
							<div class="text-sm mb-1 text-grey-dark flex items-center sm:w-auto mr-3">
								<span class="leading-none mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="3 -1 24 24" class="fill-current w-4 h-4 text-orange"><path d="M5 3h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg></span> 
								<span>Constructii / Amenajari</span>
							</div>
							<div class="text-xl md:font-semibold leading-normal">
								<a href="{{ route('user-proposal.show', $proposal) }}" class=" z-20 text-green-dark hover:text-green-dark no-underline">
									{{ $proposal->project->title }}
								</a>
							</div>
						</div>

						<div class="description mt-4">

							<span class="text-grey-darkest lg:text-lg leading-normal">
								{!! nl2br(str_limit(e($proposal->project->description), 200, '...')) !!}
								<a href="{{ route('project.show', $proposal->project) }}" class="lg:hidden no-underline text-green-dark font-semibold">vezi anuntul</a>
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

					<hr class="my-10 h-px bg-grey-light">

					<div class="proposal-details">
						
						<div class="flex flex-col md:flex-row md:items-center pb-6 md:pb-8 border-b border-grey-lighter">
							<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
								<span class="font-semibold text-grey-darkest">Timp de execuție <span class="text-red opacity-50">*</span></span>
								<span class="text-sm text-grey-darkest opacity-50 mt-2">Incercați să faceți o estimare cât mai corectă a timpului de execuție.</span>
							</div>

							<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
								<div class=" flex items-center ">
									<div class="w-auto">
										<input type="number" step="1" name="duration" value="{{ old('duration', $proposal->duration) }}" class=" font-semibold focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker w-16">
									</div>
									<div class="w-full ml-8">
										<duration-selector :durations="{{ json_encode(config('settings.duration_type')) }}" selected="{{ old('duration_type', $proposal->duration_type) }}" :error="{{ json_encode(['first' => $errors->first('duration_type')]) }}"></duration-selector>
									</div>
								</div>

								@if($errors->has('duration'))
									<span class="text-sm text-red-dark block mt-2">{{ $errors->first('duration') }}</span>
								@endif
								@if($errors->has('duration_type'))
									<span class="text-sm text-red-dark block mt-2">{{ $errors->first('duration_type') }}</span>
								@endif
							</div>

						</div>

						<div class="flex flex-col md:flex-row md:items-start py-6 md:py-8 border-b border-grey-lighter">
											
							<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
								
								<span class="font-semibold text-grey-darkest">Prețul ofertat <span class="text-red opacity-50">*</span></span>

								<span class="text-sm text-grey-darkest opacity-50 mt-2">O estimare corectă vă poate ajuta să ieșiți în evidență.</span>
					
							</div>

							<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
								
								<div class="flex items-center">
									<input type="number" step="0.01" name="price" class="font-semibold w-32 text-right focus:outline-none appearance-none p-4 bg-grey-lighter rounded-l leading-normal text-indigo-darker @if($errors->has('price')) border border-red-light @endif" value="{{ old('price', $proposal->price) }}">
									<span class="font-semibold p-4 bg-grey-lighter rounded-r leading-normal text-grey-dark">lei</span>
								</div>

								@if($errors->has('price'))
									<span class="text-sm text-red-dark block mt-2">{{ $errors->first('price') }}</span>
								@endif
								
							</div>

						</div>

						<div class="flex flex-col md:flex-row items-center py-6 md:py-8 border-b">
										
							<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
								
								<span class="font-semibold text-grey-darkest">Disponibil din</span>

								<span class="text-sm text-grey-darkest opacity-50 mt-2">Data de la care sunteți disponibil.</span>

							</div>

							<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
								
								<date-selector 
									:old="{{ json_encode([
										'available_from' => old('available_from', optional($proposal->available_from)->format('d/m/Y'))
										]) }}" 
									:errors="{{ json_encode([
										'available_from' => $errors->first('available_from')
										]) }}"
								>
								</date-selector>

							</div>

						</div>

						<div class="flex flex-col md:flex-row md:items-start py-6 md:py-8 border-b border-grey-lighter">
											
							<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
								
								<span class="font-semibold text-grey-darkest">Descrierea ofertei <span class="text-red opacity-50">*</span></span>

								<span class="text-sm text-grey-darkest opacity-50 mt-2">Includeți orice detalii considerați ca fiind necesare și importante pentru ca oferta dumneavoastră să fie cât mai clară și să iasă în evidență.</span>
								<span class="text-sm text-grey-darkest opacity-50 mt-2">Dacă este necesar, puteți solicita informații sumplimentare de la client.</span>

							</div>

							<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
								
								<textarea name="description" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker @if($errors->has('description')) border border-red-light @endif" rows="15">{{ old('description', $proposal->description) }}</textarea>
								
								<div class="flex flex-col md:flex-row items-center justify-between">

									<span>
										@if($errors->has('description'))
											<span class="text-sm text-red-dark block">{{ $errors->first('description') }}</span>
										@endif	
									</span>

									{{-- <span class="text-right text-xs text-grey">@{{ remainingChars }} / 10,000 caractere</span> --}}
								
								</div>
								
							</div>

						</div>

						<div class="flex flex-col md:flex-row items-center py-6 md:pb-2 md:pt-8">
										
							<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
								
								<span class="font-semibold text-grey-darkest">Fotografii</span>

								<span class="text-sm text-grey-darkest opacity-50 mt-2">Adaugati fotografii care pot fi relevante pentru acest anunt.</span>

							</div>

							<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">

								<image-upload :user="{{ auth()->user() }}" :uploaded="@if (old('images', $proposal->media) != null ){{ json_encode(old('images', $proposal->media)) }}@else false @endif"></image-upload>

							</div>

						</div>

					</div> {{-- end .proposal-details --}}

				</div> <!-- end .card-body -->

				<div class="card-footer bg-grey-lightest p-6 flex items-center justify-between md:px-10 border-t">

					<div>
						<a href="{{ route('user-proposal.show', $proposal) }}" class="no-underline font-semibold text-indigo-dark flex items-center hover:text-indigo-darker">
							<svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"></path></svg>
							<span>Înapoi</span>
						</a>
					</div>
					
					<button type="submit" class="btn btn-indigo">Salveaza modificarile</button>

				</div>
		
			</div> {{-- end .card --}}

		</form>

	</main>

</div>
@endsection