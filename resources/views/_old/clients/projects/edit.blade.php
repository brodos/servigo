@extends('layouts.app')

@section ('content')

<div class="shadow bg-white rounded">

    <h2 class="p-4 border-bottom bg-light">Modifica proiectul</h2>
			
	<form action="{{ route('client-projects.update', $project) }}" method="post">

		@csrf
		@method('patch')
		
		<div class="p-4">

			<div class="form-group mb-4 {{ $errors->has('name') ? ' has-error' : '' }}">
				
				<label for="name" class="font-weight-bold">Numele proiectului:</label>

				<input type="text" class="form-control" name="name" id="name" value="{{ old('name', $project->name) }}" >
				
				@if($errors->has('name'))
					<small class="form-text text-danger">{{ $errors->first('name') }}</small>
				@else
					<small class="form-text text-muted">Some helper text here.</small>
				@endif

			</div>

			<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
				
				<label for="description" class="font-weight-bold">Descrierea proiectului:</label>

				<textarea name="description" id="description" rows="10" class="form-control" >{{ old('description', $project->description) }}</textarea>

				@if($errors->has('description'))
					<small class="form-text text-danger">{{ $errors->first('description') }}</small>
				@else
					<small class="form-text text-muted text-right">0/5000 characters (minimum 50)</small>
				@endif

			</div>

		</div>

		<div class="form-group p-4 bg-light mb-0">
			
			<a href="{{ route('client-projects.index') }}" class="btn btn-link">Cancel</a>

			<button class="btn btn-primary px-4 text-uppercase font-weight-bold shadow" type="submit">Salveaza</button>

		</div>

	</form>
        
</div>

@endsection