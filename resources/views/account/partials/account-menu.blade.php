<div class="hidden pb-4 pl-6 font-bold uppercase text-sm text-blue-darker opacity-50 lg:block">Contul meu</div>

<ul class="list-reset flex flex-row justify-between border-b lg:mb-10 lg:border-0 lg:flex-col">

	<li class="w-1/4 lg:w-full">
		<a href="{{ route('user-project.index') }}" class="side-menu-item{{ request()->is('contul-meu/anunt*') ? ' is-active' : '' }}">
			<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6 2h9a1 1 0 0 1 .7.3l4 4a1 1 0 0 1 .3.7v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm9 2.41V7h2.59L15 4.41zM18 9h-3a2 2 0 0 1-2-2V4H6v16h12V9zm-2 7a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm0-4a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm-5-4a1 1 0 0 1-1 1H9a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1z"/></svg></span>
			<span>Anunțurile mele</span>
		</a>
	</li>
	<li class="w-1/4 lg:w-full">
		<a href="{{ route('user-proposal.index') }}" class="side-menu-item{{ request()->is('contul-meu/oferte*') ? ' is-active' : '' }}">
			<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18 21H7a4 4 0 0 1-4-4V5c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v11a3 3 0 0 1-3 3zm-3-3V5H5v12c0 1.1.9 2 2 2h8.17a3 3 0 0 1-.17-1zm-7-3h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2zm9 11a1 1 0 0 0 2 0V7h-2v11z"/></svg></span>
			<span>Ofertele mele</span>
		</a>
	</li>
	<li class="w-1/4 lg:w-full">
		<a href="{{ route('user-favorite.index') }}" class="side-menu-item{{ request()->is('contul-meu/favorite*') ? ' is-active' : '' }}">
			<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.1 21.98a1 1 0 0 1-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 0 1 .56-1.71l6.05-.88 2.7-5.48a1 1 0 0 1 1.8 0l2.7 5.48 6.06.88a1 1 0 0 1 .55 1.7l-4.38 4.27 1.04 6.03a1 1 0 0 1-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 0 1 .93 0l4.08 2.15-.78-4.55a1 1 0 0 1 .29-.88l3.3-3.22-4.56-.67a1 1 0 0 1-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 0 1-.75.54l-4.57.67 3.3 3.22a1 1 0 0 1 .3.88l-.79 4.55 4.09-2.15z"/></svg></span>
			<span>Favorite</span>
		</a>
	</li>
	<li class="w-1/4 lg:w-full">
		<a href="{{ route('user-conversation.index') }}" class="side-menu-item{{ request()->is('contul-meu/mesaje*') ? ' is-active' : '' }}">
			<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/></svg></span>
			<span>Mesaje</span>
		</a>
	</li>
	<li class="w-1/4 lg:w-full">
		<a href="{{ route('user-profile.show') }}" class="side-menu-item{{ request()->is('contul-meu/profil*') ? ' is-active' : '' }}">
			<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/></svg></span>
			<span>Profilul meu</span>
		</a>
	</li>
	<li class="w-1/4 lg:w-full">
		<a href="{{ route('user-account.edit') }}" class="side-menu-item{{ request()->is('contul-meu/setari*') ? ' is-active' : '' }}">
			<span><svg class="side-menu-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>
			<span>Setări</span>
		</a>
	</li>

</ul>