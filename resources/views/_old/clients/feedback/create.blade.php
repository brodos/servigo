@extends('layouts.app')

@section ('content')

<h2 class="p-4">Acorda un calificativ</h2>

@if($errors->isNotEmpty())
	<div class="alert alert-danger rounded-0" style="border-top: 5px solid red;">
		<ul class="list-unstyled">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>	
			@endforeach
		</ul>
	</div>
@endif

<form action="{{ route('client-feedback.store', $project->id) }}" method="post">

	@csrf

	<div class="shadow bg-white rounded mb-5">
			
			{{-- <input type="hidden" name="preview" value="true"> --}}

		<h2 class="p-4 border-bottom bg-light">Detalii proiect</h2>

		<div class="p-4">
			
			<h3>{{ $project->name }}</h3>
			<small class="d-block text-muted">Taguri / Data publicarii / Localitate</small>

			<h4>Trebuie adaugate detaliile despre client</h4>
			<div>
				{{ $project->description }}
			</div>
		</div>

	</div>

	<div class="shadow bg-white rounded mb-5">

		<h2 class="p-4 border-bottom bg-light">Detalii calificativ</h2>

		<div class="p-4">

			<div class="d-flex w-100 border-bottom pb-4 mb-4">
				
				<div class="w-25 pr-3">
					<p class="m-0 font-weight-bold">Calificativ acordat</p>
					<small class="text-muted">Selectati calificativul oferit pentru acest proiect.</small>
				</div>

				<div class="w-75 d-flex align-items-center">
					
					<div class="form-group m-0 flex-grow-1">

						<input 
							type="number" 
							{{-- min="1" 
							max="5" 
							step="1"  --}}
							class="w-25 form-control d-inline-block @if($errors->has('rating')) is-invalid @endif" 
							name="rating" 
							value="{{ old('rating') }}"
						>

					</div>

				</div>

			</div>

			<div class="d-flex w-100">
				
				<div class="w-25 pr-3">
					<p class="m-0 font-weight-bold">Mesaj <span class="text-muted">(optional)</span></p>
					<small class="text-muted">Acest mesaj va fi afisat impreuna cu calificativul acordat.</small>
				</div>

				<div class="w-75 d-flex align-items-center">
					
					<div class="form-group m-0 flex-grow-1">

						<textarea class="form-control @if($errors->has('message')) is-invalid @endif" name="message" rows="5">{{ old('message') }}</textarea>

					</div>

				</div>

			</div>
		
		</div>

		<div class="p-4 border-bottom bg-light">
			
			<button type="submit" class="btn btn-primary">Acorda calificativ</button>

		</div>

	</div>

</form>
@endsection