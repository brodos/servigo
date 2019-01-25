@extends('layouts.app')
@section('pageTitle', $project->title)

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => route('search.show')
	])
	@endcomponent
@endsection

@section('main-content')
<div class="container mx-auto lg:py-3 hidden lg:block">
	<a href="{{ route('search.show') }}" class="btn btn-link text-indigo-dark pl-0 inline-flex items-center">
		<svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"></path></svg>
		<span>Înapoi</span>
	</a>
</div>
<div class="content container mx-auto w-full flex-1 flex flex-col lg:flex-row-reverse">

	<aside class="w-full lg:w-1/4 lg:pl-12 flex flex-col lg:block bg-grey-lighter sm:bg-grey-lighter">

		<div class="actions flex flex-row-reverse justify-between lg:block bg-grey-lighter w-full p-3 lg:p-0 fixed pin-b pin-l z-20 lg:relative lg:pin-none ">
			
			@if (auth()->check() && $project->hasProposalFrom(auth()->user()))

				<div class="lg:mb-8 lg:mt-4 text-grey-darker text-center flex flex-col items-center justify-around lg:mx-auto">
					<span>Ofertă trimisă pe {{ $project->fetchProposalFrom(auth()->user())->submitted_at->format('d/m/Y') }}</span>
					<span class="mt-2"><a href="{{ route('user-proposal.show', $project->fetchProposalFrom(auth()->user())) }}" class="text-indigo-dark no-underline font-semibold hover:underline hover:text-indigo-darker">vezi oferta</a></span>
				</div>

			@else

				@can('create_proposal', $project)
					<div class="lg:mb-6">
						<a href="{{ route('user-proposal.create', $project) }}" class="block btn btn-green" @click="disableElement" :class="{ disabled: isDisabled }">Trimite ofertă</a>
					</div>
				@endcan

			@endif

			<div class="text-center hidden md:block">
				<save-project :project="{{ $project }}"></save-project>
			</div>

		</div>

		<div class="client p-6 lg:p-0 lg:mt-8 lg:pt-8 lg:border-t flex items-center justify-between lg:block">

			<div class="flex flex-row lg:flex-col xl:flex-row items-center">
				<img class="rounded-full w-10 h-10 lg:w-16 lg:h-16 mr-2 lg:mr-4" src="{{ $project->owner->avatar() }}" alt="">
				<div class="flex flex-col items-start lg:mt-2 xl:mt-0">
					<a href="#" class="text-sm sm:text-base lg:text-lg no-underline text-green-dark hover:underline font-bold">{{ $project->owner->displayName }}</a>
					@if ($project->owner->profile->city_id)
						<span class="mt-2 text-sm sm:text-base lg:font-semibold  text-grey-darker">{{ $project->owner->profile->location }}</span>
					@endif
				</div>
			</div>

			<div class="lg:mt-8">
				<span class="rating text-grey-dark lg:text-2xl">
					<span class="star filled">☆</span>
					<span class="star filled">☆</span>
					<span class="star filled">☆</span>
					<span class="star filled">☆</span>
					<span class="star filled">☆</span>
				</span>
				<div class="flex flex-col lg:mt-1">
					<span class="text-sm sm:text-base text-grey-darker">3 calificative</span>
					<span class="text-sm sm:text-base text-grey-darker">4 review-uri</span>
				</div>
			</div>
		</div>
	
		<div class="hidden lg:block px-6 lg:px-0">
			<div class="mt-6 lg:mt-8 leading-normal">
				<div class="flex flex-col mb-2">
					<span class="font-bold text-grey-darkest">3 anunturi publicate</span>
					<span class="text-grey-darker">33% rata angajare</span>
					<span class="text-grey-darker">2 anunturi active</span>
				</div>								
			</div>

			<div class="mt-6 lg:mt-8 text-grey-darker leading-normal">Membru din dec 2018</div>

			<div class="border-t mt-6 lg:mt-8 pt-6 pb-6 lg:pt-8 text-grey-darker">
				<div class="flex flex-col leading-loose">
					<div><span class="font-bold text-grey-darkest">Oferte primite:</span> intre 0 si 10</div>
					<div><span class="font-bold text-grey-darkest">Invitatii trimise:</span> 12</div>
					<div><span class="font-bold text-grey-darkest">Utlima vizualizare:</span> acum 3 ore</div>
				</div>
			</div>
		</div>

		{{-- <div class="sm:hidden w-full flex items-center justify-center py-2" style="box-shadow: inset 0px -2px 4px 0 rgba(0, 0, 0, .06);">
			<a href="#" class="text-xs font-bold text-blue-dark no-underline">Vezi tot</a>
		</div> --}}

	</aside>
	
	<main class="flex-1">
		
		<div class="card bg-white shadow-md md:rounded sm:shadow-lg">

			<div class="card-header p-6 lg:py-8 lg:px-10 border-b lg:border-grey-lighter bg-grey-lightest flex items-center justify-between">
							
				<span class="text-xl font-semibold md:text-2xl leading-normal text-green-dark">{{ $project->title }}</span>
				
			</div> <!-- end .card-header -->

			<div class="card-body p-6 lg:py-8 lg:px-10 text-grey-darkest">

				<div class="category flex items-center justify-between border-b pb-6 mb-6 pt-3 lg:pt-0 lg:pb-8 lg:mb-8 text-sm sm:text-base">
					<div class="text-grey-dark flex items-center sm:w-auto mr-3">
						<span class="leading-none mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4 text-orange"><path d="M5 3h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg></span> 
						<span><a href="#" class="text-indigo-dark no-underline font-bold hover:text-indigo-darker hover:underline">Constructii / Amenajari</a></span>
					</div>
					<span class="published text-grey-dark"><em>publicat {{ $project->published_at->diffForHumans() }}</em></span>
				</div>
			
				<div class="description text-grey-darkest text-sm leading-tad md:text-base">
					{!! nl2br(e($project->description)) !!}
				</div>

				<div class="mt-8 flex flex-col sm:flex-row leading-normal">
					
					@if (! $project->start_date && ! $project->end_date)
						<span class="font-bold text-lg sm:text-xl mr-2">Perioada solicitată:</span>	
						<span class="text-lg sm:text-xl">oricând</span>
					@elseif($project->start_date->diffInDays($project->end_date) > 0)
						<span class="font-bold text-lg sm:text-xl mr-2">Perioada solicitată:</span>	
						<span class="text-lg sm:text-xl">{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</span>	
					@else
						<span class="font-bold text-lg sm:text-xl mr-2">Data solicitată:</span>	
						<span class="text-lg sm:text-xl">{{ $project->start_date->toFormattedDateString() }}</span>	
					@endif
					
				</div>

				@if ($project->media->isNotEmpty())
					<div class="media border-t pt-6 mt-6 lg:pt-8 lg:mt-8">
					
						<ul class="list-reset flex flex-col lg:flex-row lg:flex-wrap">
							@foreach ($project->media as $media)
								<li class="w-full lg:w-1/2">
									<a target="_blank" href="{{ $media->asset_path }}" class="inline-block w-full pb-3 sm:pb-6 lg:px-3"><img class="h-auto w-full mx-auto  shadow-md hover:shadow-lg" src="{{ $media->asset_path }}"></a>
								</li>
							@endforeach
						</ul>

					</div> <!-- end .media -->
				@endif

				{{-- <div class="mt-2 md:mt-0 lg:-mb-6 lg:-mr-6 text-right">
					<a href="#" class="no-underline text-sm text-blue hover:text-red-dark hover:underline">Raporteaza anunt</a>
				</div> --}}

			</div> <!-- end .card-body -->

		</div> {{-- end .card --}}


		@if ($other_projects->isNotEmpty())
			<div class="card bg-white sm:rounded shadow-md sm:shadow-lg mt-12">
				
				<div class="card-header p-6 lg:py-8 lg:px-10 border-b lg:border-grey-lighter bg-grey-lightest flex items-center justify-between">
					
					<span class="text-lg lg:text-2xl leading-normal text-blue-darker">Istoric anunțuri client</span>
					
				</div> <!-- end .card-header -->

				<div class="card-body">
					
					@foreach ($other_projects as $oproject)
						<div class="anunt flex flex-col md:flex-row border-b p-6 lg:py-8 lg:px-10">
							<div class="flex-1">
								<a href="{{ route('project.show', $oproject) }}" class="font-semibold no-underline hover:underline hover:text-blue-darker md:text-lg text-blue-dark leading-normal">{{ $oproject->title }}</a> @if (! $oproject->isCompleted) <span class="text-sm text-grey-dark">(în desfășurare)</span> @endif

								@if (!empty($oproject->receivedFeedback))
									<div class="calificativ flex items-center mt-4">
										<span class="rating text-grey-dark text-lg">
											@for($i = 5; $i > 0; $i--)
												<span class="star @if($oproject->receivedFeedback->rating >= $i) filled @endif">☆</span>
											@endfor
										</span>
										{{-- <div class="ml-2 text-grey-dark">{{ number_format($oproject->receivedFeedback->rating, 1) }}</div> --}}
									</div>

									@if (! empty($oproject->receivedFeedback->message))
										<div class="review">
											<span class="text-grey-dark leading-normal text-sm"><em>{{ $oproject->receivedFeedback->message }}</em></span>
										</div>
									@endif
								@else
									<div class="calificativ flex items-center mt-4">
										<span class="text-grey-dark leading-normal text-sm">Fără calificativ</span>
									</div>
								@endif
							</div>
							<div class="md:ml-6 text-right mt-2 md:mt-0"><span class="text-grey text-sm">{{ $oproject->published_at->format('M Y') }}</span></div>
						</div> <!-- end .anunt -->

					@endforeach

				</div> {{-- end .card-body --}}

			</div> {{-- end .card --}}
		@endif

	</main>

</div>
@endsection