<div class="container mx-auto hidden lg:pb-8 lg:block">
	<a href="{{ route('user-project.index') }}" class="btn btn-link text-indigo-dark pl-0 pt-0 mt-0 inline-flex items-center">
		<svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"></path></svg>
		<span>Anunțurile mele</span>
	</a>
</div>

<div class="hidden pb-4 pl-6 font-bold uppercase text-sm text-blue-darker opacity-50 lg:block">Detalii anunț</div>

<ul class="list-reset flex flex-row justify-between border-b lg:border-0 lg:mb-10 lg:flex-col">
	<li class="w-1/4 lg:w-full">
		<a href="{{ route('user-project-proposals.index', $project) }}" class="side-menu-item{{ request()->is('contul-meu/anunturi/*/ofert*')  ? ' is-active' : '' }}">
			<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18 21H7a4 4 0 0 1-4-4V5c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v11a3 3 0 0 1-3 3zm-3-3V5H5v12c0 1.1.9 2 2 2h8.17a3 3 0 0 1-.17-1zm-7-3h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2zm9 11a1 1 0 0 0 2 0V7h-2v11z"/></svg></span>
			<span>Oferte primite</span>
		</a>
	</li>
	<li class="w-1/4 lg:w-full">
		<a href="{{ route('user-project-conversations.index', $project) }}" class="side-menu-item{{ request()->is('contul-meu/anunturi/*/mesaje*') ? ' is-active' : '' }}">
			<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/></svg></span>
			<span>Mesaje</span>
		</a>
	</li>
	<li class="w-1/4 lg:w-full">
		<a href="{{ route('user-project-promote.show', $project) }}" class="side-menu-item{{ route('user-project-promote.show', $project) == request()->url() ? ' is-active' : '' }}">
			<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 15a1 1 0 0 0 2 0V7a1 1 0 0 0-1-1h-8a1 1 0 0 0 0 2h5.59L13 13.59l-3.3-3.3a1 1 0 0 0-1.4 0l-6 6a1 1 0 0 0 1.4 1.42L9 12.4l3.3 3.3a1 1 0 0 0 1.4 0L20 9.4V15z"/></svg></span>
			<span>Promovare</span>
		</a>
	</li>
</ul>

<div class="fixed lg:relative pin-b pin-l lg:pin-none flex flex-row lg:flex-col w-full z-30 bg-white lg:bg-transparent">

	<div class="hidden lg:block pb-4 pl-6 font-bold uppercase text-sm text-blue-darker opacity-50">Stare anunt</div>

	<ul class="list-reset flex flex-row lg:flex-col items-center justify-between w-full border-t lg:border-t-0 shadow-lg lg:shadow-none">

		<li class="w-1/4 lg:w-full">
			<span class="flex flex-col items-center text-xs py-3 h-full lg:flex-row lg:text-base lg:text-left lg:ounded lg:pl-6 lg:mr-12 lg:mb-1 border border-transparent rounded hover:border-grey">
				@if ($project->completed_at != null)
					<span><svg class="side-menu-svg text-blue-dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M17.62 10H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H8.5c-1.2 0-2.3-.72-2.74-1.79l-3.5-7-.03-.06A3 3 0 0 1 5 9h5V4c0-1.1.9-2 2-2h1.62l4 8zM16 11.24L12.38 4H12v7H5a1 1 0 0 0-.93 1.36l3.5 7.02a1 1 0 0 0 .93.62H16v-8.76zm2 .76v8h2v-8h-2z"/></svg></span>
					<span class="text-blue-dark font-semibold">Finalizat</span>
				@elseif ($project->published_at == null)
					<span><svg class="side-menu-svg text-red-dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 9a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v4a1 1 0 0 1-1 1zm0 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg></span>
					<span class="text-red-dark font-semibold">Nepublicat</span>
				@elseif($project->published_at != null && $project->approved_at == null)
					<span><svg class="side-menu-svg text-orange-dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 9a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v4a1 1 0 0 1-1 1zm0 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg></span>
					<span class="text-orange font-semibold">În moderare</span>
				@else
					<span><svg class="side-menu-svg text-green-dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/></svg></span>
					<span class="text-green-dark font-semibold">Activ</span>
				@endif
			</span>
		</li>

		<li class="w-1/4 lg:w-full">
			<a href="{{ route('user-project.show', $project) }}" class="side-menu-item{{ route('user-project.show', $project) == request()->url() ? ' is-active' : '' }}">
				<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.56 17.66a8 8 0 0 1-11.32 0L1.3 12.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95zm-9.9-1.42a6 6 0 0 0 8.48 0L20.38 12l-4.24-4.24a6 6 0 0 0-8.48 0L3.4 12l4.25 4.24zM11.9 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
				<span>Vezi anunțul</span>
			</a>
		</li>

		<li class="w-1/4 lg:w-full">
			<a href="{{ route('user-project.edit', $project) }}" class="side-menu-item{{ route('user-project.edit', $project) == request()->url() ? ' is-active' : '' }}">
				<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/></svg></span>
				<span>Modifică anunțul</span>
			</a>
		</li>
		
		<li class="w-1/4 lg:w-full">
			<a href="#sterge" class="side-menu-item hover:text-red-dark hover:bg-red-lightest hover:border hover:border-red-light">
				<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/></svg></span>
				<span>Șterge anunțul</span>
			</a>
		</li>

	</ul>

</div>