@extends('layouts.app')

@section ('content')

<div class="shadow bg-white rounded mb-5">
	
	<div class="d-flex p-4 border-bottom bg-light justify-content-between">
		<h2 class="flex-fill w-100">Mesaje</h2>

		<div class="flex-fill flex-shrink-1">
			<span class="badge badge-secondary">0</span>
		</div>
	</div>
    

    @if ($projects->isEmpty())
		<div class="justify-content-center text-center ">
			<div class="p-5 lead">Nu ati primit nici-un mesaj.</div>
		</div>
	@else
		<div class="row">
			
			<div class="message-list col-4 pr-0">
				
				<div class="list-group">
					
					@foreach ($projects as $p)
						<a href="{{ route('contractor-messages.show', $p->messages->first()->id) }}" class="list-group-item list-group-item-action flex-column align-items-start rounded-0 @if ($p->id == $project->id) active @endif">
						    <div class="d-flex w-100 justify-content-between">
							    <h5 class="mb-1">{{ $p->owner->name }}</h5>
							    <small>{{ $p->messages->first()->sent_at->diffForHumans() }}</small>
						    </div>
						    <p class="mb-1">{{ $p->name }}</p>
					  	</a>
					@endforeach
				</div>

			</div>

			<div class="messages-container col-8 border-left pl-0">
				
				<div class="messages px-4">
					@foreach ($messages->get($project->id) as $message)
		
						@if ($message->isMine)
							<div class="row my-4 justify-content-end">
								<div class="w-auto max-w-50">
									<div class="card shadow px-4 bg-info">
										<div class="message text-white pt-2">{{ $message->message }}</div>
										<div class="pt-2 pb-1 text-right"><small class="text-light">{{ $message->sent_at->diffForHumans() }}</small></div>
									</div>
								</div>
							</div>
						@else
							<div class="row my-4">
								<div class="w-auto max-w-50">
									<div class="card shadow px-4">
										<div class="message pre-wrap pt-3">{{ $message->message }}</div>
										<div class="pt-2 pb-1"><small class="text-black-50">{{ $message->sent_at->diffForHumans() }}</small></div>
									</div>
								</div>
							</div>
						@endif

				    @endforeach
			    </div>

			    <form action="{{ route('contractor-messages.store', $project->id) }}" method="post">
					<div class="d-flex justify-content-between align-items-center p-4 bg-light">

						@csrf
					    <div class="flex-fill textbox">
					    	<textarea class="form-control" name="message" rows="2" placeholder="Type your message here"></textarea>
					    </div>
					    <div class="ml-3 submit">
					    	<button type="submit" class="btn btn-primary">Send</button>
					    </div>
					    
					</div>
				</form>

			</div>

		</div>
    @endif
    
</div>

@endsection