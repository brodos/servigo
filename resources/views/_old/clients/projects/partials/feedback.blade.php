<div class="shadow rounded mb-5 bg-white">
	<div class="d-flex justify-content-center align-items-center p-4 border-bottom text-black-50 bg-light">
	    <h2 class="flex-fill mb-0">Feedback acordat</h2>

	    <div class="flex-fill text-right align-self-start"></div>
	</div>

	<div class="project-content p-5">
		<div class="justify-content-center text-center ">
			@if ($project->feedback->where('from_user_id', auth()->user()->id)->count() > 0)
				<div class="pt-5 pb-4 lead">Stelute: {{ $project->feedback->where('from_user_id', auth()->user()->id)->first()->rating }}</div>
				<div class="pb-5">
					{!! nl2br(e($project->feedback->where('from_user_id', auth()->user()->id)->first()->message)) !!}
				</div>
			@else

					<div class="pt-5 pb-4 lead">Nu ati acordat feedback pentru acest proiect.</div>

					<div class="pb-5">
						<a href="{{ route('client-feedback.create', $project->id) }}" class="btn btn-primary"  role="button">Acorda feedback</a>
					</div>
			@endif
		</div>

	</div>
</div>

<div class="shadow rounded bg-white mt-5">
	<div class="d-flex justify-content-center align-items-center p-4 border-bottom text-black-50 bg-light">
	    <h2 class="flex-fill mb-0">Feedback primit</h2>

	    <div class="flex-fill text-right align-self-start"></div>
	</div>

	<div class="project-content p-5">

		<div class="justify-content-center text-center ">

			@if ($project->feedback->where('to_user_id', auth()->user()->id)->count() > 0 && $project->feedback->where('from_user_id', auth()->user()->id)->count() == 0 )

				<div class="pt-5 pb-4 lead">Ati primit feedback, dar va fi vizibil doar dupa ce veti acorda si dumneavoastra feedback-ul.</div>

			@elseif ($project->feedback->where('to_user_id', auth()->user()->id)->count() > 0 && $project->feedback->where('from_user_id', auth()->user()->id)->count() > 0)
		
				<div class="pt-5 pb-4 lead">Stelute - {{ $project->feedback->where('to_user_id', auth()->user()->id)->first()->rating }}</div>

				<div>
					
						
					
					@if ($project->feedback->where('to_user_id', auth()->user()->id)->first()->message != '')
						<div class="feedback-message">
							{!! nl2br(e($project->feedback->where('to_user_id', auth()->user()->id)->first()->message)) !!}
						</div>
					@endif
					
					<div class="mt-5">
						<a href="#" class="btn btn-secondary">Raspunde</a>
					</div>
				</div>
				
			@else
				<div class="pt-4 pb-4 lead">Nu ati primit feedback pentru acest proiect.</div>
			@endif

		</div>

	</div>
</div>