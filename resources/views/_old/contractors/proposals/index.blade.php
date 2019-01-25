@extends('layouts.app')

@section ('content')

@if ($proposals->whereIn('status', config('settings.proposal.ongoing'))->count() > 0)
<div class="shadow bg-white rounded mb-5">
	
	<div class="d-flex p-4 border-bottom bg-light justify-content-between">
		<h2 class="flex-fill w-100">Oferte acceptate/confirmate</h2>

		<div class="flex-fill flex-shrink-1">
			
		</div>
	</div>
    
	@foreach ($proposals->whereIn('status', config('settings.proposal.ongoing'))->all() as $proposal)
		<div class="border-bottom d-flex flex-column align-items-between">
			<div class="top p-3 d-flex justify-content-between">
				<div class="left flex-grow-1">
					<a href="{{ route('contractor-proposals.show', [$proposal->project->id, $proposal->id]) }}"><span class="lead">{{ $proposal->project->name }}</span></a>
				</div>
				<div class="right">
					<a href="#">
						<svg style="width:24px; height: 24px; fill: #999" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M4 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
					</a>
				</div>
			</div>

			<div class="bottom p-3 d-flex justify-content-between">
				<div>
					<span class="badge badge-secondary px-3 py-2">{{ config('settings.proposal.statuses')[$proposal->status] }} [{{ $proposal->status }}]</span>

					@if ($proposal->status === config('settings.proposal.selected')) 
						<span class="badge badge-success ml-2 px-3 py-2">Oferta acceptata!</span>
					@endif

					@if ($proposal->status === config('settings.proposal.confirmed')) 
						<span class="badge badge-primary ml-2 px-3 py-2">Oferta confirmata!</span>
					@endif
				</div>
				<div>
					<span class="text-muted">trimisa acum XX zile</span>
				</div>
			</div>
		</div>
	@endforeach
</div>
@endif

<div class="shadow bg-white rounded mb-5">
	
	<div class="d-flex p-4 border-bottom bg-light justify-content-between">
		<h2 class="flex-fill w-100">Oferte trimise</h2>

		<div class="flex-fill flex-shrink-1">
			
		</div>
	</div>
    

    @if ($proposals->isEmpty())
		<div class="justify-content-center text-center ">
			<div class="pt-5 pb-4 lead">Nu ati facut nici-o oferta.</div>

			<div class="pb-5">
				<a href="#" class="btn btn-primary"  role="button">Cauta proiecte</a>
			</div>
		</div>
	@else
		@foreach ($proposals->whereIn('status', config('settings.proposal.active'))->all() as $proposal)
			<div class="border-bottom d-flex flex-column align-items-between">
				<div class="top p-3 d-flex justify-content-between">
					<div class="left flex-grow-1">
						<a href="{{ route('contractor-proposals.show', [$proposal->project->id, $proposal->id]) }}"><span class="lead">{{ $proposal->project->name }}</span></a>
					</div>
					<div class="right">
						<a href="#">
							<svg style="width:24px; height: 24px; fill: #999" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M4 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
						</a>
					</div>
				</div>

				<div class="bottom p-3 d-flex justify-content-between">
					<div>
						<span class="badge badge-secondary px-3 py-2">{{ config('settings.proposal.statuses')[$proposal->status] }} ({{ $proposal->status }})</span>
					</div>
					<div>
						<span class="text-muted">trimisa acum XX zile</span>
					</div>
				</div>
			</div>
		@endforeach
    @endif
    
</div>

@if ($proposals->where('status', config('settings.proposal.completed'))->count() > 0)
<div class="shadow bg-white rounded mb-5">
	
	<div class="d-flex p-4 border-bottom bg-light justify-content-between">
		<h2 class="flex-fill w-100">Oferte incheiate</h2>

		<div class="flex-fill flex-shrink-1">
			
		</div>
	</div>
    
	@foreach ($proposals->where('status', config('settings.proposal.completed'))->all() as $proposal)
		<div class="border-bottom d-flex flex-column align-items-between">
			<div class="top p-3 d-flex justify-content-between">
				<div class="left flex-grow-1">
					<a href="{{ route('contractor-proposals.show', [$proposal->project->id, $proposal->id]) }}"><span class="lead">{{ $proposal->project->name }}</span></a>
				</div>
				<div class="right">
					<a href="#">
						<svg style="width:24px; height: 24px; fill: #999" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M4 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm8 2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
					</a>
				</div>
			</div>

			<div class="bottom p-3 d-flex justify-content-between">
				<div>
					<span class="badge badge-secondary px-3 py-2">{{ config('settings.proposal.statuses')[$proposal->status] }} ({{ $proposal->status }})</span>
				
				</div>
				<div>
					<span class="text-muted">trimisa acum XX zile</span>
				</div>
			</div>
		</div>
	@endforeach
</div>
@endif

@endsection

@section('right-sidebar')
<div class="col-3 d-flex flex-column align-items-start justify-content-start">


	<div class="widget mb-3">
		
		<span class="d-block text-uppercase font-weight-bold text-black-50 text-monospace">Options</span>

		<a href="#">Another widget</a>

	</div>

</div>
@endsection

