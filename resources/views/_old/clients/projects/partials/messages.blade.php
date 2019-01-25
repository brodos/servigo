<div class="d-flex justify-content-center align-items-center p-4 border-bottom bg-light text-black-50">
    <h2 class="flex-fill mb-0">Mesaje primite</h2>
    <div class="flex-fill text-right align-self-start"></div>
</div>

<div class="project-content p-5">

    @foreach ($project->messages as $message)
		
		@if ($message->isMine)
			<div class="row justify-content-end my-4">
				<div class="col-9">
					<div class="card shadow rounded px-4 bg-info">
						<div class="font-weight-bold pb-2 pt-2 text-right">{{ $project->owner->name }}</div>
						<div class="message pre-wrap text-white text-justify">{{ $message->message }}</div>
						<div class="pt-2 pb-1 text-right"><small class="text-light">{{ $message->sent_at->diffForHumans() }}</small></div>
					</div>
				</div>
			</div>
		@else
			<div class="row my-4">
				<div class="col-9">
					<div class="card shadow rounded px-4">
						<div class="font-weight-bold py-2">{{ $project->winningProposal->owner->name }}</div>
						<div class="message pre-wrap text-justify">{{ $message->message }}</div>
						<div class="pt-2 pb-1"><small class="text-black-50">{{ $message->sent_at->diffForHumans() }}</small></div>
					</div>
				</div>
			</div>
		@endif

    @endforeach

</div>

<form action="{{ route('client-message.store', $project->id) }}" method="post">
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