@extends('layouts.app')
@section('pageTitle', 'Contul meu')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'home',
		'url' => route('search.show')
	])
	@endcomponent
@endsection

@section('main-content')

<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

	<aside class="w-full lg:w-1/4">					
			
		@include('account.partials.account-menu')

	</aside>

	<main class="flex-1">
		
		<div class="card bg-white md:rounded md:shadow-lg">

			<div class="card-header p-6 lg:py-8 lg:px-10 border-b bg-grey-lightest flex items-center justify-between">
				<div class="flex flex-col">
					<span class="text-xl w-full leading-normal text-grey-darker md:font-semibold md:w-auto uppercase">Anunțurile mele</span>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">
		
				@forelse ($projects as $project)

					<div class="project-item relative w-full p-6 lg:py-8 lg:px-10 hover:bg-grey-lightest 
						@if ($project->completed_at != null) 
							border-l-4 border-blue-light 
						@elseif ($project->published_at == null) 
							border-l-4 border-grey 
						@elseif($project->published_at != null && $project->approved_at == null)
							border-l-4 border-yellow-light
						@else
							border-l-4 border-green-light
						@endif">

						<div class="top text-xs text-grey-dark sm:text-sm flex items-center w-full justify-between mb-2 lg:mb-1 z-10">

							<div class="flex items-center sm:w-auto mr-3">
								<span class="leading-none mr-1"><svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="3 -1 24 24"><path d="M5 3h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg></span> 
								<span>Constructii / Amenajari</span>
							</div>
							
							@if ($project->owner->profile->city_id != null)
								<div class="flex items-center sm:w-auto">
									<span class="leading-none mr-1"><svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24"><path d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
									<span>{{ $project->owner->profile->location }}</span>
								</div>
							@endif

						</div> {{-- end .top --}}

						<div class="project-title leading-normal">
							<a href="{{ route('user-project-proposals.index', $project) }}" class="text-black text-xl no-underline md:font-semibold  hover:text-green-dark">
								{{ $project->title }}
							</a>
						</div>
						
						<div class="mt-6 leading-normal">
							{{-- <div class="text-grey-darkest text-sm sm:text-base">
								{{ str_limit($project->description, 200) }}
							</div> --}}

							{{-- @if ($project->start_date !== null)
								<div class="mt-3 flex flex-col text-sm sm:flex-row sm:text-base">
									<span class="text-grey-dark mr-2">Perioada solicitată:</span>
									<span class="text-grey-darkest">Luni, 1 aug 2018 - Vineri, 6 aug 2018</span>
								</div>
							@endif

							<div class="mt-2 flex text-sm sm:text-base md:hidden">
								<span class="text-grey-dark mr-2">Oferte:</span>
								<span class="text-grey-darkest"><10</span>
							</div> --}}
						</div>
							
						

						<div class="mt-6 flex flex-col md:flex-row items-start md:items-center justify-between">

							<div class="flex items-center mb-6 md:mb-0">

								<div class="flex items-center text-sm">
									@if ($project->completed_at != null)
										<span class="text-blue-dark bg-blue-lightest border border-blue-light py-1 px-4 rounded-full font-semibold">finalizat</span>
									@elseif ($project->published_at == null)
										<span class="text-grey-darker bg-grey-lighter border border-grey py-1 px-4 rounded-full font-semibold">nepublicat</span>
									@elseif($project->published_at != null && $project->approved_at == null)
										<span class="text-yellow-darker bg-yellow-lighter border border-yellow py-1 px-4 rounded-full font-semibold">în moderare</span>
									@else
										<span class="text-green-dark bg-green-lightest border border-green-light py-1 px-4 rounded-full font-semibold">activ</span>

										@if ($project->selected_proposal_id != null) 
											<span class="ml-2 text-orange-dark bg-orange-lightest border border-orange-light py-1 px-4 rounded-full font-semibold whitespace-no-wrap">ofertă acceptată</span>	
										@endif
									@endif
								</div>

							</div>

							<div class="flex items-center z-10">

								<div class="mr-4 flex items-center text-grey-dark leading-none">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-4 h-4"><path class="heroicon-ui" d="M17.56 17.66a8 8 0 0 1-11.32 0L1.3 12.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95zm-9.9-1.42a6 6 0 0 0 8.48 0L20.38 12l-4.24-4.24a6 6 0 0 0-8.48 0L3.4 12l4.25 4.24zM11.9 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
									<span class="ml-1 text-sm font-semibold">{{ mt_rand(0, 100) }}</span>
								</div>

								<div class="mr-4 flex items-center text-grey-dark leading-none">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-4 h-4"><path d="M6.1 21.98a1 1 0 0 1-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 0 1 .56-1.71l6.05-.88 2.7-5.48a1 1 0 0 1 1.8 0l2.7 5.48 6.06.88a1 1 0 0 1 .55 1.7l-4.38 4.27 1.04 6.03a1 1 0 0 1-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 0 1 .93 0l4.08 2.15-.78-4.55a1 1 0 0 1 .29-.88l3.3-3.22-4.56-.67a1 1 0 0 1-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 0 1-.75.54l-4.57.67 3.3 3.22a1 1 0 0 1 .3.88l-.79 4.55 4.09-2.15z"></path></svg>
									<span class="ml-1 text-sm font-semibold">{{ mt_rand(0, 100) }}</span>
								</div>

								<div class="flex items-center text-grey-dark leading-none">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current w-4 h-4"><path d="M18 21H7a4 4 0 0 1-4-4V5c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v11a3 3 0 0 1-3 3zm-3-3V5H5v12c0 1.1.9 2 2 2h8.17a3 3 0 0 1-.17-1zm-7-3h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2zm9 11a1 1 0 0 0 2 0V7h-2v11z"></path></svg>
									<span class="ml-1 text-sm font-semibold">{{ $project->proposals_count }}</span>
								</div>

							</div>

						</div>

						<a href="{{ route('user-project-proposals.index', $project) }}" class="absolute pin-t pin-r w-full h-full"></a>

					</div>

					<div class="h-px bg-grey-light"></div>

				@empty

					<div class="flex flex-col items-center justify-center px-6 py-10">

						<span class="text-lg md:text-2xl font-semibold text-grey-darkest">Nu ați adăugat nici-un anunț.</span>
						
						<a href="{{ route('user-project.create') }}" class="mt-10 btn btn-green">Adaugă un anunț</a>

					</div>

				@endforelse

			</div>

			{{ $projects->links() }}
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection