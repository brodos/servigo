@extends('layouts.app')

@section ('content')

<h2 class="p-4">Trimite o oferta</h2>

{{-- <div class="shadow bg-white rounded mb-5">

	<h2 class="p-4 border-bottom bg-light">Setari proiect</h2>

	<div class="p-4">
		<p>This proposal requires 2 Connects </p>
		<p>When you submit a proposal, you'll have 58 Connects remaining. Your Connects reset on December 11.</p>
	</div>

</div> --}}

@if($errors->isNotEmpty())
	<div class="alert alert-danger rounded-0" style="border-top: 5px solid red;">
		<ul class="list-unstyled">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>	
			@endforeach
		</ul>
	</div>
@endif

<form action="{{ route('contractor-proposals.store', $project->id) }}" method="post">
	@csrf

	<div class="shadow bg-white rounded mb-5">
			
			{{-- <input type="hidden" name="preview" value="true"> --}}

		<h2 class="p-4 border-bottom bg-light">Detalii proiect</h2>

		<div class="p-4">
			
			<h3>{{ $project->name }}</h3>
			<small class="d-block text-muted">Taguri / Data publicarii / Localitate</small>

			<div>
				{{ $project->description }}
			</div>
		</div>

	</div>

	<div class="shadow bg-white rounded mb-5">

		<h2 class="p-4 border-bottom bg-light">Termeni oferta</h2>

		<div class="p-4">

			<div class="d-flex w-100 border-bottom pb-4 mb-4">
				
				<div class="w-25 pr-3">
					<p class="m-0 font-weight-bold">Durata de executie</p>
					<small class="text-muted">Luati in calcul orice intarzieri care ar putea apare pe parcurs.</small>
				</div>

				<div class="w-75 d-flex align-items-center">
					
					<div class="form-group m-0 flex-grow-1 @if($errors->has('price') || $errors->has('duration_type')) has-error @endif">

						<div class="d-flex">
							<input type="number" min="1" step="1" class="w-25 form-control d-inline-block" name="duration" value="{{ old('duration') }}">
							
							<select class="w-25 ml-4 form-control d-inline-block" name="duration_type">
								<option value="">-- Select an option --</option>
								<option value="10">10 test</option>
								@foreach (config('settings.duration_type') as $key => $dt)
									<option value="{{ $key }}" @if ($key == old('duration_type')) selected="selected" @endif>{{ $dt }}</option>
								@endforeach
							</select>
						</div>

					</div>

				</div>

			</div>

			<div class="d-flex w-100 border-bottom pb-4 mb-4">
				
				<div class="w-25 pr-3">
					<p class="m-0 font-weight-bold">Pretul</p>
					<small class="text-muted">O estimare corecta va poate ajuta la castigarea proiectului.</small>
				</div>

				<div class="w-75 d-flex align-items-center">
					
					<div class="form-group m-0 flex-grow-1 @if($errors->has('price')) has-error @endif">

						<div class="d-flex">
							<input type="number" step="1" class="w-25 form-control d-inline-block" name="price" value="{{ old('price') }}">
						</div>

					</div>

				</div>

			</div>


			<div class="d-flex w-100 border-bottom pb-4 mb-4">
				
				<div class="w-25 pr-4">
					<p class="m-0 font-weight-bold">Disponibil din</p>
					<small class="text-muted">Data la care ati putea sa incepeti executarea proiectului.</small>
				</div>

				<div class="w-75 d-flex align-items-center">
					
					<div class="flex-grow-1 mb-0 form-group @if($errors->has('start_date')) has-error @endif">
						
						<input type="date" class="w-25 form-control" name="start_date" value="{{ old('start_date') }}">

					</div>

				</div>

			</div>

			<div class="d-flex w-100 border-bottom pb-4 mb-4">
				
				<div class="w-25 pr-4">

					<p class="m-0 font-weight-bold">Propunerea ta</p>
					<small class="text-muted">Adauga o descriere cat mai detaliata a ofertei tale.</small>
				</div>

				<div class="w-75 d-flex align-items-center">
					
					<div class="form-group flex-grow-1 m-0 @if($errors->has('description')) has-error @endif">
						
						<textarea class="form-control" name="description" rows="10">{{ old('description') }}</textarea>

					</div>

				</div>

			</div>

			<div class="d-flex w-100">
				
				<div class="w-25">
					<p class="font-weight-bold m-0">Atasamente</p>
					<small class="text-muted">Poti adauga oricate atasamente (imagini si documente).</small>
				</div>

				<div class="w-75">
					
					<div class="border-dashed rounded bg-light p-5 d-flex justify-content-center align-items-center">
						
						<span class="text-black-50">Trage fisierele aici</span>

					</div>

				</div>

			</div>
		
		</div>

		<div class="p-4 border-bottom bg-light">
			
			<button class="btn btn-link">Salveaza</button>
			<button type="submit" class="btn btn-primary">Trimite oferta</button>

		</div>

	</div>

</form>
@endsection