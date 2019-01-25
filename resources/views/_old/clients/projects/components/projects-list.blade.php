<div class="content shadow-lg rounded" role="tab-content">
	
	<div class="flex w-full items-center justify-between py-8 px-10 bg-grey-lightest border-b ">
		<div class="font-semibold text-lg tracking-wide text-blue-darker uppercase">{{ $title }}</div>
		<div class="button">
			
			<a href="{{ route('client-projects.create') }}" class="btn btn-green" @click="disableElement" :class="{ disabled: isDisabled }">
				Adauga anunt
			</a>

		</div>
	</div>

	<div>

		@if($projects->count() == 0)
			
			<div class="content-item w-full cursor-pointer border-b">

				<div class="bg-white p-8 flex flex-col justify-between leading-normal hover:bg-blue-lightest">
				
					@if (in_array($type, ['finalizate','ciorne']))
						{{ $no_projects }}
					@endif

				</div>

			</div>

		@else
		
			@foreach ($projects as $project)

				<div class="content-item w-full border-b relative" href="{{ route('client-projects.index') }}" :class="{ 'cursor-pointer': jsEnabled }" @click="navigate('{{ route('client-projects.show', $project) }}')">
									
					<div class="bg-white p-10 flex flex-col justify-between leading-normal hover:bg-blue-lightest">
					
						<div class="lg:mb-8 flex flex-col lg:flex-row items-start pb-8 lg:pb-0">
							<div class="flex-1">
								<div class="font-bold text-xl mb-2">
									<a href="{{ route('client-projects.show', $project) }}" class="text-black hover:text-green no-underline">{{ $project->name }}</a>
								</div>
								<div class="text-grey-darker text-base">
									{!! nl2br(str_limit(e($project->description), 250, '...')) !!}
								</div>
							</div>
							@if ($project->isPublished)
								<div class="flex justify-around items-center leading-none w-full lg:w-auto pt-8 lg:pt-0">
									
									@component('clients.projects.components.favorites-count')
										{{ $project->favorites_count }}
									@endcomponent
									
									@component('clients.projects.components.views-count')
										{{ mt_rand(100, 300) }}
									@endcomponent

									@component('clients.projects.components.proposals-count')
										{{ $project->proposals_count }}
									@endcomponent
								
								</div>
							@endif
						</div>

						<div class="flex flex-col-reverse sm:flex-row justify-start items-center">

							<div class="text-sm text-grey-dark flex items-center leading-none w-full sm:w-auto">
								<span class="leading-none mr-1">
									<svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path  d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"/></svg>
								</span>
								<span 
									class="font-semibold tracking-tight" 
									title="{{ $project->published_at ? $project->published_at->toFormattedDateString() : $project->created_at->toFormattedDateString() }}"
								>
									{{ $project->published_at ? 'publicat ' . $project->published_at->diffForHumans() : 'creat ' . $project->created_at->diffForHumans() ?? '' }}
								</span>
							</div>

							<div class="sm:ml-auto pb-8 sm:pb-0 ">
								@component('clients.projects.components.tags', ['tags' => ['winter', 'summer', 'wonderfull']])
									
								@endcomponent
							</div>
							
						</div>

					</div>	

				</div> <!-- end .content-item -->

			@endforeach

		@endif

	</div>

</div> <!-- end .content -->