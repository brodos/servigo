@extends('layouts.app')
@section('pageTitle', 'Mesaje')

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

			<div class="card-header p-6 md:p-8 border-b md:border-grey-lighter bg-grey-lightest flex items-center justify-between">
				<div class="flex flex-col">
					<span class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto">Mesaje</span>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">
			
				@if ($conversations->isEmpty())
					<div class="flex flex-col items-center justify-center px-6 py-10">
						<span class="text-lg md:text-2xl font-semibold text-grey-darkest">Nu aveți mesaje.</span>						
					</div>
				@else
					@foreach ($conversations as $conversation)
						<div class="conversation relative p-6 md:p-8 hover:bg-indigo-lightest @if($conversation->unreadMessagesCount > 0) border-indigo border-l-4 @endif">
							<div>
								<div class="person flex items-center">
									@if (auth()->id() == $conversation->project->owner->id)
										<img class="w-12 h-12 rounded-full mr-4" src="{{ $conversation->proposal->owner->avatar() }}">
									@else
										<img class="w-12 h-12 rounded-full mr-4" src="{{ $conversation->project->owner->avatar() }}">
									@endif
									
									<div class="flex-1 flex flex-col items-start">
										<div class="flex items-center">											
											<a href="#" class="md:text-lg flex items-center no-underline text-green-dark hover:underline font-semibold mr-2 leading-normal">
												@if (auth()->id() == $conversation->project->owner->id)
													<span>{{ $conversation->proposal->owner->displayName }} </span>
													<span class="inline-block ml-3 bg-orange text-white font-bold text-xs sm:text-sm traking-tight rounded-full py-px px-2 opacity-75">ofertant</span> 
												@else
													<span>{{ $conversation->project->owner->displayName }} </span>
													<span class="inline-block ml-3 bg-green-dark text-white font-bold text-xs sm:text-sm traking-tight rounded-full py-px px-2 opacity-75">client</span> 
												@endif
											</a>
										</div>

										<div class="text-grey-darkest sm:text-lg md:text-xl font-semibold mt-1">
											Re: {{ str_limit($conversation->project->title, 75, '...') }}
										</div>
									</div>

									<div class="hidden text-sm text-grey-dark md:flex md:items-center sm:w-auto ml-3 self-start">
										<span class="leading-none mr-1 text-blue"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"></path></svg></span> 
										<span title="{{ $conversation->updated_at->format('j M Y H:i:s ') }}">
											{{ $conversation->updated_at->diffForHumans() }}
										</span>
									</div>

								</div>
								<div class="text-sm text-grey-dark mt-6 sm:text-base">{{ str_limit($conversation->messages->last()->body, 75) }}</div>
							</div>
							<a href="{{ route('user-conversation.show', $conversation) }}" class="z-10 absolute pin-t pin-l w-full h-full "></a>

						</div>
						<div class="h-px bg-grey-light"></div>
					@endforeach
				@endif

			</div>
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection