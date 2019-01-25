@extends('layouts.main')

@section('main-content')

<div class="p-0 lg:p-6 lg:flex w-full justify-center">

	<div class="md:p-6 flex w-full">

		<div class="content shadow-lg rounded flex-1">

			<form method="post" action="{{ route('client-projects.store') }}" enctype="multipart/form-data">
				@csrf

			<div class="flex flex-col md:flex-row w-full items-center justify-between py-6 px-6 bg-grey-lightest border-b">
				
				<div class="text-bold text-2xl tracking-wide text-black">Adauga un anunt nou</div>

				@if($errors->isNotEmpty())
				
					<div class="text-red text-sm mt-4 md:mt-0">Formularul are niste erori.</div>

				@endif

			</div>

			<div class="content-item w-full">

				<div class="bg-white p-4 md:p-8 flex flex-col justify-between leading-normal">
				
					<div class="flex flex-col md:flex-row md:items-center pb-6 md:pb-8 border-b border-grey-light">
						
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Titlu <span class="text-red opacity-50">*</span></span>

							<span class="text-sm text-grey-darkest opacity-50">Adauga un titlu cat mai sugestiv pentru solicitarea dumneavoastra.</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<input type="text" name="name" class="font-bold w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-tight text-grey-darkest" value="{{ old('name') }}">
							
							@if ($errors->has('name'))
								<span class="text-sm text-red">{{ $errors->first('name') }}</span>
							@endif

						</div>

					</div>

					<div class="flex flex-col md:flex-row items-start py-6 md:py-8 border-b">
						
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Descriere <span class="text-red opacity-50">*</span></span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2">Detaliile fac diferenta. Un anunt clar si concis va atrage cele mai bune oferte.</span>
							<span class="text-sm text-grey-darkest opacity-50 mt-2">Aveti la dispozitie 10000 de caractere. Lasati mintea libera.</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<textarea name="description" class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-tight text-grey-darkest" rows="20">{{ old('description') }}</textarea>

							@if ($errors->has('description'))
								<span class="text-sm text-red">{{ $errors->first('description') }}</span>
							@endif

						</div>

					</div>

					<div class="flex flex-col md:flex-row items-center py-6 md:py-8 border-b">
						
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Data inceperii</span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2">Optional - puteti specifica data (de) la care se doreste prestarea serviciului.</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">
							
							<input type="text" name="start_date" class="w-full md:w-auto focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-tight text-grey-darkest" value="{{ old('start_date') }}">

						</div>

					</div>

					<div class="flex flex-col md:flex-row items-center py-6 md:pb-2 md:pt-8">
						
						<div class="w-full md:w-1/4 flex flex-col items-start justify-center">
							
							<span class="font-semibold text-grey-darkest">Fotografii</span>

							<span class="text-sm text-grey-darkest opacity-50 mt-2"><em>"O poza face cat 1000 de cuvinte"</em>. Stim stim, clasicul cliseu, dar este adevarat... de cele mai multe ori.</span>

						</div>

						<div class="w-full md:w-3/4 md:pl-8 mt-4 md:mt-0">

							<image-upload :user="{{ auth()->user() }}" :uploaded="@if (old('images', null) != null ){{ json_encode(old('images')) }}@else false @endif"></image-upload>

						</div>

					</div>

				</div>

			</div>

			<div class="flex w-full items-center justify-between md:justify-start py-6 px-6 md:p-8 bg-grey-lighter">
				
				<a href="{{ route('client-projects.index') }}" class="font-bold md:text-sm text-blue-dark hover:text-blue-darker no-underline uppercase tracking-wide leading-tight md:mr-auto text-xs">Renunta</a>

				<a href="#" class="btn btn-green-secondary" @click.prevent="disableElement" :class="{ disabled: isDisabled }">Salveaza</a>

				<button type="submit" class="btn btn-green md:ml-6" @click="disableElement" :class="{ disabled: isDisabled }">Publica<span class="hidden md:inline"> anuntul</span></button>

			</div>

			</form>

		</div>

	</div>

</div>

@endsection