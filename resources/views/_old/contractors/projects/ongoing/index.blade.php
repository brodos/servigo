@extends('layouts.app')

@section ('content')

<div class="shadow bg-white rounded mb-5">
	
	<div class="d-flex p-4 border-bottom bg-light justify-content-between">
		<h2 class="flex-fill w-100">Proiecte in desfasurare</h2>

		<div class="flex-fill flex-shrink-1">
			<span class="badge badge-secondary">{{ $projects->count() }}</span>
		</div>
	</div>
    

    @if ($projects->isEmpty())
		<div class="justify-content-center text-center ">
			<div class="p-5 lead">Nu exista proiecte in desfasurare.</div>
		</div>
	@else
		@foreach ($projects as $project)
			<div class="border-bottom d-flex flex-column align-items-between">
				<div class="top p-3 d-flex justify-content-between">
					<div class="left flex-grow-1">
						<a href="{{ route('contractor-ongoing-projects.show', $project->id) }}"><span class="lead">{{ $project->name }}</span></a>
					</div>
					<div class="right">
						<a href="#">
							<svg style="width:24px; height: 24px; fill: #999" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M4 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
						</a>
					</div>
				</div>

				<div class="bottom p-3 d-flex justify-content-between">
					<div>
						Locatie / stele / tags / buton de salvare / oferte primite / data publicarii
						
					</div>
					<div>
						
					</div>
				</div>
			</div>
		@endforeach
    @endif
    
</div>

@endsection

@section('right-sidebar')
<div class="col-3 d-flex flex-column align-items-start justify-content-start">
	
	nu stiu ce sa pun aici

</div>
@endsection

