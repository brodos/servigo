@extends('layouts.app')
@section('pageTitle', 'Adauga anunt')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => url()->previous()
	])
	@endcomponent
@endsection

@section('main-content')
<div class="container mx-auto lg:py-3 hidden lg:block">
	<a href="{{ url()->previous() }}" class="btn btn-link text-indigo-dark pl-0 inline-flex items-center">
		<svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"></path></svg>
		<span>Înapoi</span>
	</a>
</div>
<div class="content container mx-auto w-full flex-1 flex flex-col lg:flex-row">
	
	<main class="flex-1">
		
		<div class="card bg-white shadow-md md:rounded sm:shadow-lg">

			<form method="post" action="{{ route('user-project.store') }}" enctype="multipart/form-data">
			@csrf

			<div class="card-header p-6 md:p-8 border-b md:border-grey-lighter bg-grey-lightest">
				<div class="flex flex-col items-center md:flex-row justify-between">
					<span class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto">Adaugă un anunț nou</span>

					@if($errors->isNotEmpty())
				
						<div class="text-red text-sm mt-4 md:mt-0">Formularul are niste erori.</div>

					@endif
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">

				<div class="bg-white p-6 md:p-8 flex flex-col justify-between leading-normal w-full">
								
					<div class="flex flex-col md:flex-row md:items-center pb-6 md:pb-8 border-b border-grey-lighter">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Titlul <span class="text-red opacity-50">*</span></span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2">Adaugă un titlu cât mai sugestiv și descriptiv pentru solicitarea ta.</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<input type="text" name="title" class="font-semibold w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker @if($errors->has('title')) border border-red-light @endif" value="{{ old('title') }}">

							@if($errors->has('title'))
								<span class="text-sm text-red-dark block mt-2">{{ $errors->first('title') }}</span>
							@endif
							
						</div>

					</div>

					<div class="flex flex-col md:flex-row md:items-start py-6 md:py-8 border-b border-grey-lighter">
											
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Descrierea solicitării <span class="text-red opacity-50">*</span></span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2">Detaliile fac diferența. Un anunț clar și concis va atrage mai multe oferte.</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<textarea id="js-textarea" v-model="textareaText" name="description" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker @if($errors->has('description')) border border-red-light @endif" rows="20">{{ old('description') }}</textarea>
							
							<div class="flex flex-col md:flex-row items-center justify-between">

								<span>
									@if($errors->has('description'))
										<span class="text-sm text-red-dark block">{{ $errors->first('description') }}</span>
									@endif	
								</span>

								<span class="text-right text-xs text-grey">@{{ remainingChars }} / 10,000 caractere</span>
							
							</div>
							
						</div>

					</div>

					<div class="flex flex-col md:flex-row items-center py-6 md:py-8 border-b">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Perioada solicitată</span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2">Specificați perioada în care doriți prestarea serviciului solicitat.</span>
							<span class="text-sm text-grey-darkest opacity-50 mt-1">Dacă serviciul este solicitat doar pentru o zi, atunci completați acceași dată în ambele câmpuri.</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<date-range-selector 
								:old="{{ json_encode([
									'start_date' => old('start_date'), 
									'end_date' => old('end_date'),
									'asap' => old('asap') ? true : false
									])}}" 
								:errors="{{ json_encode([
									'start_date' => $errors->first('start_date'),
									'end_date' => $errors->first('end_date'),
									'asap' => $errors->first('asap'),
									]) }}"
							>
							</date-range-selector>

						</div>

					</div>

					<div class="flex flex-col md:flex-row items-center py-6 md:pb-2 md:pt-8">
										
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Fotografii</span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2"><em>"O fotografie face cât 1000 de cuvinte"</em>. Da, știm știm, clasicul clișeu, dar este adevarat... de cele mai multe ori.</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">

							<image-upload :user="{{ auth()->user() }}" :uploaded="@if (old('images', null) != null ){{ json_encode(old('images')) }}@else false @endif"></image-upload>

						</div>

					</div>

				</div>

			</div>

			<div class="card-footer bg-grey-lightest p-6 md:p-8 border-t border-grey-lighter flex items-center justify-between">
				
				<a href="{{ url()->previous() }}" class="hidden btn btn-link text-indigo-dark pl-0 flex-1 md:flex items-center">
					<svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"></path></svg>
					<span>Înapoi</span>
				</a>

				<input id="save-project" type="submit" value="Salvează" class="btn btn-green-secondary focus:outline-none" @click="disableElement" :class="{ disabled: isDisabled }" />

				<button type="submit" class="btn btn-green md:ml-6  focus:outline-none" @click="disableElement" :class="{ disabled: isDisabled }">Publică<span class="hidden md:inline"> anunțul</span></button>

			</div>
	
			</form>

		</div> {{-- end .card --}}

	</main>

</div>
@endsection