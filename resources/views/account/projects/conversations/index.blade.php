@extends('layouts.app')
@section('pageTitle', 'Mesaje')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => route('user-project.index')
	])
	@endcomponent
@endsection

@section('main-content')

<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">

	<aside class="w-full lg:w-1/4">
	
		@include('account.partials.project-menu')

	</aside>

	<main class="flex-1">

		<div class="p-6 md:p-0 md:pb-8 flex justify-between">
			<span class="text-indigo-darker font-bold text-lg md:text-2xl">{{ $project->title }}</span>
		</div>
		
		<div class="card bg-white md:rounded md:shadow-lg">

			<div class="card-header p-6 md:py-8 md:px-10 border-b md:border-grey-lighter bg-grey-lightest flex items-center justify-between">
				<div class="flex flex-col">
					<span class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto">Mesaje</span>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">

				@if ($conversations->isEmpty())
					<div class="flex flex-col items-center justify-center px-6 py-10">
						<span class="text-lg md:text-2xl font-semibold text-grey-darkest">Nu ați inițiat nici-o conversație.</span>
						<span class="mt-8 text-grey-dark">Puteți iniția conversații vizualizând <a class="text-blue-dark text-lg no-underline hover:underline hover:text-red-dark" href="{{ route('user-project-proposals.index', $project) }}">ofertele primite</a>.</span>
					</div>
				@else
					@foreach ($conversations as $conversation)
						<div class="conversation relative hover:bg-indigo-lightest @if($conversation->unreadMessagesCount > 0) border-l-4 border-indigo @endif">
							<div class="person flex items-center  p-6 md:p-8 ">
								<img class="w-12 h-12 rounded-full mr-4" src="{{ $conversation->proposal->owner->avatar() }}">
								<div class="flex-1 flex flex-col items-start">
									<div class="flex items-center">											
										<a href="#" class="text-base md:text-lg inline-block no-underline text-green-dark hover:underline font-semibold mr-2">
											{{ $conversation->proposal->owner->displayName }}
										</a>
									</div>

									<div class="text-grey-darker mt-1 md:mt-2 text-sm md:text-base">{{ str_limit($conversation->messages->last()->body, 75) }}</div>
								</div>

								<div class="hidden text-sm text-grey-dark md:flex md:items-center sm:w-auto ml-3">
									<span class="leading-none mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"></path></svg></span> 
									<span title="{{ $conversation->messages->last()->created_at->format('j M Y H:i:s ') }}">
										{{ $conversation->messages->last()->created_at->diffForHumans() }}
									</span>
								</div>

							</div>
							<a href="{{ route('user-project-conversations.show', [$project, $conversation]) }}" class="z-10 absolute pin-t pin-l w-full h-full "></a>
							
							<div class="h-px bg-grey-light"></div>
						</div>
					@endforeach
				@endif

			</div>

			<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection