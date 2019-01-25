<div class="content shadow-lg rounded" role="tab-content">
	
	<div class="flex w-full items-center justify-between py-6 px-6 bg-grey-lightest border-b ">
		<div class="text-bold text-2xl tracking-wide text-black">Oferte primite</div>
	</div>

	@if($project->proposals_count == 0)
			
		<div class="content-item w-full border-b">

			<div class="bg-white p-6 flex flex-col justify-between leading-normal hover:bg-blue-lightest">
			
				Nu ati primit oferte pentru acest anunt.

			</div>

		</div>

	@else

		@foreach ($project->proposals as $proposal)

			<div class="content-item w-full border-b relative">

				<div class="bg-white p-6 flex flex-col justify-between leading-normal hover:bg-blue-lightest">
					
					<div class="lg:mb-8 flex flex-col lg:flex-row items-start pb-8 lg:pb-0">

					</div>

				</div>	

			</div>

		@endforeach

	@endif

</div>


@if(1==2)
<div class="d-flex justify-content-center align-items-center p-4 border-bottom bg-light text-black-50">
    <h2 class="flex-fill mb-0">Oferte primite</h2>

    <div class="flex-fill text-right align-self-start">
        
        <span class="badge badge-success px-4 py-2 text-uppercase">{{ $project->proposals_count }} oferte</span>
		
    </div>
</div>

<div class="project-content" id="project-proposals">

	@if($project->proposals_count == 0)
		<div class="justify-content-center text-center ">
			<div class="pt-5 pb-4 lead">Nu ati primit nici-o oferta pana acum.</div>

			<div class="pb-5">
				<a href="#" class="btn btn-primary"  role="button">Promoveaza proiectul</a>
			</div>
		</div>
	@endif

	@foreach($project->proposals as $proposal)

        <div class="d-flex border-bottom p-4" ref="proposal">
        	
			<div class="mr-3">
				<img style="border-radius: 50%;" src="https://placeimg.com/60/60/peopl?v={{ $loop->iteration }}">
			</div>
			<div class="flex-grow-1 d-flex flex-column align-items-start">
				<div class="d-flex flex-column justify-content-center mb-2 w-100">
					<div class="flex-grow-1">
						<a href="#" class="d-inline-block font-weight-bold text-success">
							{{ $proposal->owner->name }}
						</a>
						<span class="d-inline-block text-success">
							@for($i = 1; $i <=5; $i++)
								<svg class="fill-current m-0 p-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path d="M6.1 21.98a1 1 0 0 1-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 0 1 .56-1.71l6.05-.88 2.7-5.48a1 1 0 0 1 1.8 0l2.7 5.48 6.06.88a1 1 0 0 1 .55 1.7l-4.38 4.27 1.04 6.03a1 1 0 0 1-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 0 1 .93 0l4.08 2.15-.78-4.55a1 1 0 0 1 .29-.88l3.3-3.22-4.56-.67a1 1 0 0 1-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 0 1-.75.54l-4.57.67 3.3 3.22a1 1 0 0 1 .3.88l-.79 4.55 4.09-2.15z"/></svg>
							@endfor
						</span>
						@if ($proposal->isDismissed)
							<span class="d-inline-block text-danger">Eliminat!</span>
						@endif
						@if ($proposal->isSaved)
							<span class="d-inline-block text-info">Salvat!</span>
						@endif
						@if ($proposal->isAccepted)
							<span class="d-inline-block text-success">Acceptat!</span>
						@endif
						@if ($proposal->isConfirmed)
							<span class="d-inline-block badge badge-primary py-2 px-3">Confirmat!</span>
						@endif
					</div>
					<span class="d-block text-muted">Electrician montantor in instalatii trifazate</span>
				</div>

				<div class="text-justify mb-3">
					{!! nl2br(str_limit(e($proposal->description), 130, '...')) !!}
				</div>

				<div class="meta text-muted d-flex justify-content-between w-100">
					<div>
						<small class="font-weight-bold">
							<svg class="fill-current d-inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="14" height="14"><path d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
							<span class="d-inline-block">Piatra Neamt, Neamt</span>
						</small>
					</div>
					<div>
						<span class="font-weight-bold">
							Termen: {{ $proposal->duration . ' ' . config('settings.duration_type')[$proposal->duration_type] }}
						</span>
					</div>
				</div>
			</div>
			<div class="ml-3 d-flex flex-column align-items-start">

				<div class="lead font-weight-bold text-nowrap mb-auto">{{ number_format($proposal->price, 0) }} lei</div>
				<div>
					<a target="_blank" 
						onClick="event.preventDefault(); axios.post('{{ route('client-read-proposal', [$project->id, $proposal->id]) }}').then(function(res) { alert(res.data); location.reload(); });" 
						href="{{ route('client-dismiss-proposal', [$project->id, $proposal->id]) }}" 
						class="d-block"
					>Markeaza ca {{ $proposal->read == 0 ? 'citit' : 'necitit' }}</a>

					<a target="_blank" 
						href="{{ route('client-proposal.show', [$project->id, $proposal->id]) }}" 
						class="d-block"
					>Deschide</a>
					
					<a target="_blank" 
						onClick="event.preventDefault(); axios.post('{{ route('client-dismiss-proposal', [$project->id, $proposal->id]) }}').then(function(res) { alert(res.data); location.reload(); });" 
						href="{{ route('client-dismiss-proposal', [$project->id, $proposal->id]) }}" 
						class="d-block"
					>Elimina</a>

					<a target="_blank" 
					onClick="event.preventDefault(); axios.post('{{ route('client-save-proposal', [$project->id, $proposal->id]) }}').then(function(res) { alert(res.data); location.reload(); });" 
					href="{{ route('client-save-proposal', [$project->id, $proposal->id]) }}" 
					class="d-block"
					>Salveaza</a>
	
					{{-- @if($project->isActive) --}}

						<a target="_blank" 
						onClick="event.preventDefault(); axios.post('{{ route('client-accept-proposal', [$project->id, $proposal->id]) }}').then(function(res) { alert(res.data); location.reload(); });" 
						href="{{ route('client-accept-proposal', [$project->id, $proposal->id]) }}" 
						class="d-block text-nowrap"
						>Accepta</a>
						
					{{-- @endif --}}

				</div>

			</div>

        </div>

	@endforeach

</div>
@endif