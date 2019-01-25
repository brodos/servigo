@extends('layouts.app')
@section('pageTitle', 'Mesaje')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => str_contains(url()->previous(), '/oferte-favorite') ? route('user-project-favorites.index', $project) : route('user-project-proposals.index', $project)
	])
	@endcomponent
@endsection

@section('main-content')

<div class="content container mx-auto w-full flex-1 lg:py-12 flex flex-col lg:flex-row">
	
	<aside class="w-full lg:w-1/4">
	
		@include('account.partials.project-menu')

	</aside>

	<main class="flex-1">

		<div class="pb-8">
			<span class="text-indigo-darker font-bold text-lg md:text-2xl">{{ $project->title }}</span>
		</div>
		
		
		<div class="card bg-white md:rounded md:shadow-lg">

			<div class="card-header md:sticky md:pin-t md:z-10 p-6 md:p-8 border-b bg-grey-lightest">
				<div class="person flex items-center">
					<div class="back mr-8 hidden md:block">
						<a href="{{ str_contains(url()->previous(), '/contul-meu/anunturi') ? route('user-project-conversations.index', $project) : route('user-conversation.index') }}" class="text-grey-darkest hover:text-blue no-underline">
							<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/></svg>
						</a>
					</div>
					@if (auth()->id() == $project->owner->id)
						<img class="w-12 h-12 rounded-full mr-3" src="{{ $conversation->proposal->owner->avatar() }}">
					@else
						<img class="w-12 h-12 rounded-full mr-3" src="{{ $project->owner->avatar() }}">
					@endif

					<div class="flex-1 text-left">
						<div class="flex flex-col">
							<a href="#" class="md:text-lg no-underline text-green-dark hover:underline font-semibold mr-2 leading-normal">
								{{ $conversation->proposal->owner->displayName }}
							</a>
							@if ($conversation->proposal->owner->profile->city_id)
								<span class=" text-sm text-grey-dark mt-1">{{ $conversation->proposal->owner->profile->location }}</span>
							@endif
						</div>
					</div>

					<div class="hidden text-sm md:flex md:items-center sm:w-auto ml-3">
						@if (auth()->id() == $project->owner->id)
							<a href="{{ route('user-project-proposals.show', [$project, $conversation->proposal]) }}" class="btn btn-grey-secondary flex items-center leading-none">
								<span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M18 21H7a4 4 0 0 1-4-4V5c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v11a3 3 0 0 1-3 3zm-3-3V5H5v12c0 1.1.9 2 2 2h8.17a3 3 0 0 1-.17-1zm-7-3h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2zm9 11a1 1 0 0 0 2 0V7h-2v11z"></path></svg></span> 
								<span>Vezi oferta</span>
							</a>
						@else
							<a href="{{ route('project.show', $project) }}" target="_blank" class="btn btn-grey-secondary flex items-center leading-none">
								<span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M6 2h9a1 1 0 0 1 .7.3l4 4a1 1 0 0 1 .3.7v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm9 2.41V7h2.59L15 4.41zM18 9h-3a2 2 0 0 1-2-2V4H6v16h12V9zm-2 7a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm0-4a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm-5-4a1 1 0 0 1-1 1H9a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1z"/></svg></span> 
								<span>Vezi anunțul</span>
							</a>
						@endif
						
					</div>
					
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">
			
				<div id="messages" class="mesaje p-6 pb-4 md:p-8 md:pb-4 shadow-inner flex flex-col">

					@if ($conversation->messages->isEmpty())
						<div class="text-sm self-center rounded-full bg-black px-4 py-2 text-white opacity-50 my-6">Nu există mesaje.</div>
					@else

						@foreach ($conversation->messages as $message)
					
							<span class="{{ $message->sender->id == auth()->id() ? 'me' : 'other' }} message md:min-w-1/6 md:text-base">
								{!! nl2br(e($message->body)) !!}
								<span class="absolute pin-b pin-r time text-xs text-grey-dark opacity-75 mr-2 mb-1 lowercase">
									{{ $message->created_at->format('j M, H:i') }}
								</span>
							</span>

						@endforeach
	
					@endif

				</div> <!-- end #messages -->

			</div> <!-- end .card-body -->

			<form action="{{ route('user-message.store', $conversation) }}" method="post">
				@csrf
				<input type="hidden" name="return_to" value="{{ route('user-project-conversations.show', [$project, $conversation]) }}">
				<div class="card-footer bg-white p-6 pt-0 md:p-8 md:pt-0 flex flex-col items-start justify-between">
					<div class="w-full">
						<textarea class="w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-normal text-indigo-darker" name="message" rows="2" placeholder="Scrie aici..." autofocus required></textarea>

						@if ($errors->has('message'))
							<span class="text-sm text-red-dark inline-block mt-1">{{ $errors->first('message') }}</span>
						@endif
					</div>
					<div class="w-full mt-2 text-right">
						<button type="submit" class="inline-block ml-auto btn btn-indigo-secondary flex items-center">
							<svg class="mr-2 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 0l20 10L0 20V0zm0 8v4l10-2L0 8z"/></svg>
							<span>Trimite mesajul</span>
						</button>
					</div>
				</div>
			</form>
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection

@section('scripts')
	<script>
		var messagesDiv = document.getElementById("messages");
		messagesDiv.scrollTop = messagesDiv.scrollHeight;
	</script>	
@endsection