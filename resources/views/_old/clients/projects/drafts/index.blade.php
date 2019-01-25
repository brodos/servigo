@extends('layouts.app')

@section ('content')

@if ($projects->count() > 0)
<div class="shadow bg-white rounded mb-5">
	<div class="d-flex p-4 border-bottom bg-light justify-content-between">
		<h2 class="flex-fill w-100">Ciorne</h2>
		<div class="flex-fill flex-shrink-1"></div>
	</div>
	
	@foreach ($projects as $project)
		<div class="border-bottom d-flex flex-column align-items-between">
			<div class="top p-3 d-flex justify-content-between">
				<div class="left flex-grow-1">
					<a href="{{ route('client-projects.show', $project ) }}"><span class="lead">{{ $project->name }}</span></a>
				</div>
				<div class="right">
					<a href="#">
						<svg style="width:24px; height: 24px; fill: #999" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M4 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
					</a>
				</div>
			</div>

			<div class="bottom p-3 d-flex justify-content-between">
				<div>
					<span class="badge badge-warning px-3 py-2">{{ $statuses['statuses'][$project->status] }} [{{ $project->status }}]</span>
				</div>
				<div>
					<span class="text-muted">creat {{ $project->created_at->diffForHumans() }}</span>
					<span class="text-muted">--</span>
					<span>{{ $project->proposals->count() }} oferte</span>
				</div>
			</div>
		</div>
	@endforeach
</div>
@endif

@endsection

@section('right-sidebar')
<div class="col-3 d-flex flex-column align-items-start justify-content-start">
	
	<div class="widget mx-auto mb-4 pb-4 border-bottom border-secondary">
		
		<a href="{{ route('client-projects.create') }}" class="btn btn-primary">
			<svg class="mr-1 mb-1" style="width: 1rem; height: 1rem; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg>
			New project
		</a>

	</div>

	<div class="widget mb-3">
		
		<span class="d-block text-uppercase font-weight-bold text-black-50 text-monospace">Options</span>

		<a href="#">Another widget</a>

	</div>

</div>
@endsection

