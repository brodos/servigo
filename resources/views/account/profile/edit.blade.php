@extends('layouts.app')
@section('pageTitle', 'Profilul meu')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => route('user-profile.show')
	])
	@endcomponent
@endsection

@section('main-content')
<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

	<aside class="w-full lg:w-1/4">	
		
		@include('account.partials.account-menu')

	</aside>

	<main class="flex-1">

		<form method="post" action="{{ route('user-profile.update') }}" enctype="multipart/form-data">
			@csrf
			@method('put')
		
			<div class="card bg-white md:rounded md:shadow-lg">

				<div class="card-header p-6 lg:py-8 lg:px-10 border-b md:border-grey-lighter bg-grey-lightest flex items-center">
					<div class="back mr-8 hidden md:block">
						<a href="{{ route('user-profile.show') }}" class="text-grey-darkest hover:text-blue no-underline">
							<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24"><path class="heroicon-ui" d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/></svg>
						</a>
					</div>
					<span class="text-xl flex-1 leading-normal text-indigo-darker md:font-semibold md:w-auto">Actualizează profilul</span>
				</div> <!-- end .card-header -->

				<div class="card-body p-6 lg:p-10">

					@if($errors->isNotEmpty())
				
						<div class="text-red text-sm p-8 mb-10 bg-red-lightest font-semibold">Formularul are niște erori.</div>

					@endif

					<div class="flex flex-col md:flex-row md:items-start pb-6 md:pb-8 border-b border-grey-lighter">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Avatar</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<avatar-upload 
								:current="{{ json_encode($user->avatar()) }}"
								:error="{{ json_encode(['first' => $errors->first('avatar')]) }}"
							></avatar-upload>
							
						</div>

					</div>

					<div class="flex flex-col md:flex-row md:items-start py-6 md:py-8 border-b border-grey-lighter">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Numele afișat <span class="text-red opacity-50">*</span></span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2">Acest nume va fi afișat alături de anunțurile și ofertele dumneavoastră.</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<input type="text" name="display_name" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker @if($errors->has('display_name')) border border-red-light @endif" value="{{ old('display_name', $user->profile->display_name) }}">

							@if($errors->has('display_name'))
								<span class="text-sm text-red-dark block mt-1">{{ $errors->first('display_name') }}</span>
							@endif
							
						</div>

					</div>

					<div class="flex flex-col md:flex-row md:items-start py-6 md:py-8 border-b border-grey-lighter">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Locația <span class="text-red opacity-50">*</span></span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">

							<div class="relative">
							
								<select data-county="{{ old('county_id', $user->profile->county_id) }}" name="county_id" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker @if($errors->has('county_id')) border border-red-light @endif" @change="changedCounty" ref="counties">
									<option>- alege un județ -</option>
									@foreach ($counties as $county)
										<option value="{{ $county->id }}" @if($county->id == old('county_id', $user->profile->county_id)) selected="selected" @endif>{{ $county->name }}</option>
									@endforeach
								</select>
								<div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
	    							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
	  							</div>

								@if($errors->has('county_id'))
									<span class="text-sm text-red-dark block mt-1">{{ $errors->first('county_id') }}</span>
								@endif

							</div>

							<div class="mt-6 relative" v-show="hasCounty" v-cloak>
							
								<select data-city="{{ old('city_id', $user->profile->city_id) }}" name="city_id" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker @if($errors->has('city_id')) border border-red-light @endif" @change="selectCity" ref="cities">
									<option>- alege o localitate -</option>
									<option v-for="city in cities" :value="city.id" :selected="selectedCity == city.id">@{{ city.name }}</option>
								</select>
								
								<div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
	    							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
	  							</div>

								@if($errors->has('city_id'))
									<span class="text-sm text-red-dark block mt-1">{{ $errors->first('city_id') }}</span>
								@endif

							</div>
							
						</div>

					</div>

					<div class="field-group flex flex-col md:flex-row md:items-start py-6 md:py-8 border-b border-grey-lighter">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Introducere <span class="text-red opacity-50">*</span></span>
							
							<span class="text-sm text-grey-darkest opacity-50 mt-2">Încearcă să descrii intr-o singură propoziție experiența ta profesională.</span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2"><em>Această introducere este relevantă doar dacă vei trimite oferte către clienți.</em></span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<input type="text" name="tagline" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker @if($errors->has('tagline')) border border-red-light @endif" value="{{ old('tagline', $user->profile->tagline) }}">

							@if($errors->has('tagline'))
								<span class="text-sm text-red-dark block mt-1">{{ $errors->first('tagline') }}</span>
							@endif								

						</div>

					</div> {{-- end .field-group --}}

					<div class="field-group flex flex-col md:flex-row md:items-start py-6 md:py-8 border-b border-grey-lighter">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Descriere <span class="text-red opacity-50">*</span></span>
							
							<span class="text-sm text-grey-darkest opacity-50 mt-2">Folosiți această descriere pentru a arăta clienților că aveți aptitudinile, experiența și toate cele necesare prestării serviciului ofertat.</span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2"><em>Această descriere este relevantă doar dacă veți trimite oferte către clienți.</em></span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<textarea type="text" name="bio" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker @if($errors->has('bio')) border border-red-light @endif" rows="15">{{ old('bio', $user->profile->bio) }}</textarea>
							
							@if($errors->has('bio'))
								<span class="text-sm text-red-dark block mt-1">{{ $errors->first('bio') }}</span>
							@endif								
							
						</div>

					</div> {{-- end .field-group --}}

					<div class="flex flex-col md:flex-row md:items-start py-6 md:py-8 border-b border-grey-lighter">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Link personalizat</span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2">Puteți folosi acest link pentru a promova profilul dumneavoastră.</span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2"><em>(opțional)</em></span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">

							<div class="flex items-center">
								
								<span class="font-semibold p-4 bg-grey-lighter rounded-r leading-normal text-grey-dark pr-0 @if($errors->has('slug_name')) border border-red-light border-r-0 @endif">{{ url('/p') . '/' }}</span>

								<input type="text" name="slug_name" class="w-full focus:outline-none appearance-none p-4 pl-px  bg-grey-lighter rounded-r font-semibold leading-normal text-indigo-dark @if($errors->has('slug_name')) border border-red-light border-l-0 @endif" value="{{ old('slug_name', $user->profile->slug_name) }}">

							</div>
							
							@if($errors->has('slug_name'))
								<span class="text-sm text-red-dark block mt-1">{{ $errors->first('slug_name') }}</span>
							@endif
							
						</div>

					</div> {{-- end .field-group --}}

					<div class="field-group flex flex-col md:flex-row md:items-start pt-6 md:pt-8">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Link personal</span>
							
							<span class="text-sm text-grey-darkest opacity-50 mt-2">Un link către o pagină web personala sau profilul/pagina de Facebook, etc.</span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2"><em>(opțional)</em></span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<input type="url" name="personal_url" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker @if($errors->has('personal_url')) border border-red-light @endif" value="{{ old('personal_url', $user->profile->personal_url) }}">
							
							@if($errors->has('personal_url'))
								<span class="text-sm text-red-dark block mt-1">{{ $errors->first('personal_url') }}</span>
							@endif
							
						</div>

					</div> {{-- end .field-group --}}

				</div> {{-- end .card-body --}}

				<div class="card-footer bg-grey-lightest p-6 flex items-center justify-between md:px-10 border-t">

					<div>
						<a href="{{ route('user-profile.show') }}" class="no-underline font-semibold text-indigo-dark flex items-center hover:text-indigo-darker">
							<svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"></path></svg>
							<span>Înapoi</span>
						</a>
					</div>
					
					<button type="submit" class="btn btn-indigo">Salvează <span class="hidden sm:inline-block">modificările</span></button>

				</div>
		
			</div> {{-- end .card --}}

		</form>

	</main>

</div>
@endsection