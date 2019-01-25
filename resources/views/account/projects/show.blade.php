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

<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

	<aside class="w-full lg:w-1/4">					
			
		@include('account.partials.project-menu')

	</aside>

	<main class="flex-1">
		
		<div class="card bg-white lg:rounded lg:shadow-lg">

			<div class="card-header p-6 lg:px-10 border-b lg:border-grey-lighter bg-grey-lightest flex items-center justify-between">
				<span class="text-xl font-semibold lg:text-2xl leading-normal text-green-dark">{{ $project->title }}</span>
				<div class="text-red text-sm lg:mt-4 lg:mt-0">
					<a href="{{ route('user-project.edit', $project) }}" class="text-indigo-dark no-underline hover:text-indigo-darkest" title="Modifica anuntul">
						<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/></svg>
					</a>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body p-6 lg:py-8 lg:px-10 text-grey-darkest">
			
				<div class="category flex items-center justify-between border-b pb-6 mb-6 pt-3 lg:pt-0 lg:pb-8 lg:mb-8 text-sm sm:text-base">
					<div class="text-grey-dark flex items-center sm:w-auto mr-3">
						<span class="leading-none mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4 text-orange"><path d="M5 3h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg></span> 
						<span><a href="#" class="text-indigo-dark no-underline font-bold hover:text-indigo-darker hover:underline">Constructii / Amenajari</a></span>
					</div>
					<span class="published text-grey-dark"><em>publicat {{ $project->published_at->diffForHumans() }}</em></span>
				</div>

				<div class="description">

					<span class="description text-grey-darkest text-sm leading-tad md:text-base">
						{!! nl2br(e($project->description)) !!}
					</span>

				</div>

				<div class="mt-8 flex flex-col sm:flex-row leading-normal">
					
					@if (! $project->start_date && ! $project->end_date)
						<span class="font-bold text-lg sm:text-xl mr-2">Perioada solicitată:</span>	
						<span class="text-lg sm:text-xl">oricând</span>
					@elseif($project->start_date->diffInDays($project->end_date) > 0)
						<span class="font-bold text-lg sm:text-xl mr-2">Perioada solicitată:</span>	
						<span class="text-lg sm:text-xl">{{ $project->start_date->toFormattedDateString() }} - {{ $project->end_date->toFormattedDateString() }}</span>	
					@else
						<span class="font-bold text-lg sm:text-xl mr-2">Data solicitată:</span>	
						<span class="text-lg sm:text-xl">{{ $project->start_date->toFormattedDateString() }}</span>	
					@endif
					
				</div>
				
				@if ($project->hasMedia)
					<div class="media border-t pt-6 mt-6 lg:pt-8 lg:mt-8">
					
						<ul class="list-reset flex flex-col lg:flex-row lg:flex-wrap">
							@foreach ($project->media as $media)
								<li class="w-full lg:w-1/2">
									<a target="_blank" href="{{ asset($media->path) }}" class="inline-block w-full pb-3 sm:pb-6 lg:px-3"><img class="h-auto w-full mx-auto  shadow-md hover:shadow-lg" src="{{ asset($media->path) }}"></a>
								</li>
							@endforeach
						</ul>

					</div> <!-- end .media -->
				@endif

			</div> <!-- end .card-body -->

	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection