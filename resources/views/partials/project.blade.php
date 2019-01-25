<div class="project-item relative w-full border-b p-6 lg:py-8 lg:px-10 hover:bg-indigo-lightest">
	<div class="project-main">
		<div class="text-sm mb-1 text-grey-dark flex items-center sm:w-auto mr-3">
			<span class="leading-none mr-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4 text-orange"><path d="M5 3h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg></span> 
			<span>Constructii / Amenajari</span>
		</div>

		<div class="text-xl md:font-semibold leading-normal">
			<a href="{{ route('project.show', $project) }}" class=" z-20 text-green-dark hover:text-green-darker no-underline">
				{{ $project->title }}
			</a>
		</div>
	
		<div class="mt-6 leading-normal">
			<div class="text-grey-dark text-sm sm:text-base">
				{{ str_limit($project->description, 200) }}
			</div>

			
			<div class="mt-3 flex flex-col text-sm sm:flex-row sm:text-base">
				@if (! $project->start_date && ! $project->end_date)
					<span class="text-grey-dark mr-2">Perioada solicitată:</span>	
					<span class="text-grey-darkest">oricând</span>
				@elseif($project->start_date->diffInDays($project->end_date) > 0)
					<span class="text-grey-dark mr-2">Perioada solicitată:</span>	
					<span class="text-grey-darkest">{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</span>	
				@else
					<span class="text-grey-dark mr-2">Data solicitată:</span>	
					<span class="text-grey-darkest">{{ $project->start_date->format('d/m/Y') }}</span>	
				@endif
			</div>
			

			<div class="mt-2 flex text-sm sm:text-base md:hidden">
				<span class="text-grey-dark mr-2">Oferte:</span>
				<span class="text-grey-darkest"><10</span>
			</div>

			@if (auth()->check() && $project->hasProposalFrom(auth()->user()))
				<div class="mt-6 text-sm sm:text-base text-blue-dark flex items-center sm:w-auto font-semibold">
					<svg class="hidden fill-current mr-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/></svg>
					<span>Ofertă trimisă pe {{ $project->fetchProposalFrom(auth()->user())->submitted_at->format('d/m/Y') }}</span>
				</div>
			@endif

		</div>
		
	</div>

	<div class="mt-6 flex items-center justify-between">
		<div class="flex items-center">

			<div class="text-sm text-grey-dark flex items-center sm:w-auto mr-4">
				<span class="leading-none mr-1 text-blue-dark"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24" class="fill-current w-4 h-4"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"></path></svg></span> 
				<span title="Dec 1, 2018">acum 2 zile</span>
			</div>

			<div class="text-sm text-grey-dark flex items-center sm:w-auto mr-4">
				<span class="leading-none mr-1 text-blue-dark"><svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -2 24 24"><path d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
				<span>Piatra Neamt, NT</span>
			</div>

			<div class="text-sm text-grey-dark flex items-center mr-4 sm:w-auto hidden  md:block">
				<span class="mr-1">Oferte:</span>
				<span class="text-grey-darkest">&lt;10</span>
			</div>
			
		</div>

		<div class="flex items-center z-10">
			
			<div>
				<span class="text-sm text-grey-dark mr-1 hidden">Adauga la favorite</span>
				<favorite :entity="{{ $project }}"></favorite>
			</div>
			
		</div>
	</div>

	<a href="{{ route('project.show', $project) }}" class="absolute pin-t pin-r w-full h-full"></a>
</div>