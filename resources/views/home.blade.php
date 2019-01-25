@extends('layouts.app')
@section('pageTitle', 'Servigo - bursa de servicii')

@section('mobile-top')
@endsection

@section('top-bar')
	<div class="top-nav flex items-center justify-end w-full lg:w-auto fixed pin-b pin-l md:relative bg-white z-20">
		
		<div class="border-t md:border-none w-full md:w-auto links px-3 py-8 md:px-0 md:py-0">
							
			<ul class="list-reset flex items-center justify-between md:justify-end">

				<li class="mr-4">
					<a href="{{ route('user-project.index') }}" class="btn btn-grey-secondary px-2 sm:px-3">Contul meu</a>
				</li>
				
				<li>
					<a href="{{ route('user-project.create') }}" class="btn btn-green px-2 sm:px-3">Adaugă anunț</a>
				</li>

			</ul>

		</div>

	</div>
@endsection

@section('main-content')
<div class="bg-indigo-dark border-t border border-indigo-darker md:pb-6">

	<div class="container mx-auto flex flex-col items-center justify-center pt-8 md:pt-10 px-3 md:px-32 md:pt-16 text-center">
		<h1 class="text-white opacity-75 text-3xl font-bold mb-3 md:mb-6 leading-normal md:text-5xl">Bursa de servicii</h1>

		<p class="text-white opacity-50 mx-auto text-lg max-w-md md:text-2xl leading-normal">
            Locul de intalnire al clientilor si furnizorilor de servicii din Romania.
        </p>

        <div class="w-full px-3 py-6 sm:px-0 md:py-0 my-6 md:my-12">

        	<form action="{{ route('search.show') }}">
				<div class="w-full relative">
					<input name="q" type="search" class="w-full bg-grey-lighter appearance-none rounded text-base lg:text-lg text-blue-darker border p-6 focus:bg-white focus:shadow-inner focus:outline-none" placeholder="Cauta..." style="padding-left: 3em;">
					<span class="absolute pin-t pin-l text-grey" style="padding-top: 1.45em; padding-left: 1.15em;">
						<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
					</span>
					<span class="lg:hidden absolute pin-t pin-r z-10 opacity-75" style="padding-top: 1.05em; padding-right: 1.15em;">
						<a href="#" class="text-indigo-dark hover:text-indigo-darker">
							<svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
						</a>
					</span>
				</div>

				<div class="hidden lg:flex justify-between">

					<div class="w-full relative mt-4 lg:mt-6">
						<input name="cat" type="text" class="w-full bg-grey-lighter appearance-none rounded text-blue-darker text-sm border p-4 pl-10  focus:bg-white focus:shadow-inner focus:outline-none" placeholder="Toate categoriile">
						<span class="absolute pin-t pin-l pl-3 pt-4 text-grey">
							<svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M5 3h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg>
						</span>
						
					</div>

					<div class="w-full relative mt-4 lg:mt-6 ml-4">
						<input name="j" type="search" class="w-full bg-grey-lighter appearance-none rounded text-blue-darker text-sm  border p-4 pl-10  focus:bg-white focus:shadow-inner focus:outline-none" placeholder="Toata tara">
						<span class="absolute pin-t pin-l pl-3 pt-4 text-grey">
							<svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
						</span>
					</div>

					<div class="relative mt-4 lg:mt-6 ml-4 text-center lg:block">
						<button class="btn btn-grey-secondary bg-indigo-light border-indigo-light hover:bg-indigo-lightest text-white px-6 whitespace-no-wrap flex items-center">
							<svg class="fill-current w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
							<span>Cauta acum</span>
						</button>
					</div>
				</div>

			</form>

		</div>

	</div>

</div>

<div>
	<div class="container mx-auto text-center px-6 py-16 leading-normal">
		<h2 class="text-2xl md:text-4xl text-grey-darkest font-normal">
			<span class="whitespace-no-wrap">Cum functioneaza?</span>
			<span>Simplu!</span>
		</h2>
	</div>
</div>

<div class="bg-white">
	<div class="w-full max-w-2xl mx-auto py-10 md:py-20 px-6">
		<div class="flex flex-col md:flex-row">
			<div class="flex-1 md:w-1/3 leading-normal md:mx-8">
				<div class="text-grey-darkest text-2xl md:font-bold mb-4">Clientii <span class="text-indigo">solicita</span> serviciile dorite</div> 
				<p class="text-grey-darker opacity-50 text-lg  mb-6">
        			Spre deosebire de alte site-uri de anunturi, pe platforma Servigo, clientii publica anunturi solicitand serviciile dorite. Apoi, furnizorii de servicii pot face oferte clientului pentru prestarea respectivului serviciu.
    			</p>
    			<p class="text-grey-darker text-lg">Cauti un zugrav pentru a varui o camera? Sau cauti un fotograf pentru viitoarea ta nunta? Adauga anuntul cu solicitarea ta pe platforma Servigo.</p>
    		</div>

    		<div class="flex-1 md:w-2/3 md:mx-8 mt-8 md:mt-0 flex items-center justify-center">
    			<img src="https://via.placeholder.com/640x400" class="shadow-lg rounded-lg">
    		</div>
    	</div>
    </div>
</div>

<div class="bg-grey-lighter">
	<div class="w-full max-w-2xl mx-auto py-10 md:py-20 px-6">
		<div class="flex flex-col-reverse md:flex-row">

			<div class="flex-1 md:w-2/3 md:mx-8 mt-8 md:mt-0 flex items-center justify-center">
    			<img src="https://via.placeholder.com/640x400" class="shadow-lg rounded-lg">
    		</div>

			<div class="flex-1 md:w-1/3 leading-normal md:mx-8">
				<div class="text-grey-darkest text-2xl md:font-bold mb-4">Furnizorii <span class="text-indigo">oferteaza</span></div> 
				<p class="text-grey-darker opacity-50 text-lg  mb-6">
        			Furnizorii de servicii vor putea gasi solicitarile clientilor utilizand functia de cautare de pe platforma. In functie de solicitarile clientului, furnizorii vor face oferte pentru prestarea acelui serviciu. De asemenea, clientii pot la randul lor sa caute furnizori folosind motorul de cautare si sa-i invite pe cei selectati sa faca o oferta pentru solicitarea lor.
    			</p>
    			<p class="text-grey-darker text-lg">Esti prestator de servicii? Intra pe Servigo si cauta solicitari de servicii relevante pentru domeniul tau de activitate sau interes.</p>
    		</div>
    	</div>
    </div>
</div>

<div class="bg-white">
	<div class="w-full max-w-2xl mx-auto py-10 md:py-20 px-6">
		<div class="flex flex-col md:flex-row">
			<div class="flex-1 md:w-1/3 leading-normal md:mx-8">
				<div class="text-grey-darkest text-2xl md:font-bold mb-4">Clientii aleg oferta <span class="text-indigo">potrivita</span></div> 
				<p class="text-grey-darker opacity-50 text-lg  mb-6">
        			Clientii vor analiza ofertele primite, vor putea verifica portofoliile furnizorilor si review-urile primite de acestia de la alti clienti care au colaborat cu acel furnizor sau pot contacta furnizorii selectati folosind sistemul de mesagerie interna, apoi vor accepta oferta unui anumit furnizor.
    			</p>
    			<p class="text-grey-darker text-lg">Servigo nu se doreste a fi o platforma de licitatii, intrucat oferta cea mai mica nu e neaparat si cea castigatoare. Clientii vor alege in functie de rating-ul furnizorului, portofoliul, timpul de executie sau alte detalii relevante din oferta primita.</p>
    		</div>

    		<div class="flex-1 md:w-2/3 md:mx-8 mt-8 md:mt-0 flex items-center justify-center">
    			<img src="https://via.placeholder.com/640x400" class="shadow-lg rounded-lg">
    		</div>
    	</div>
    </div>
</div>

<div class="bg-grey-lighter">
	<div class="w-full max-w-2xl mx-auto py-10 md:py-20 px-6">
		<div class="flex flex-col-reverse md:flex-row">

			<div class="flex-1 md:w-2/3 md:mx-8 mt-8 md:mt-0 flex items-center justify-center">
    			<img src="https://via.placeholder.com/640x400" class="shadow-lg rounded-lg">
    		</div>

			<div class="flex-1 md:w-1/3 leading-normal md:mx-8">
				<div class="text-grey-darkest text-2xl md:font-bold mb-4">Furnizorul selectat <span class="text-indigo">confirma</span></div> 
				<p class="text-grey-darker opacity-50 text-lg  mb-6">
        			Furnizorul a carui oferta a fost acceptata are posibilitatea de a solicita informatii suplimentare de la client sau oricare alte detalii necesare, iar apoi poate confirma acceptarea prestarii serviciului in conditiile stabilite in oferta.
    			</p>
    			<p class="text-grey-darker text-lg">In acest fel, furnizorii de servicii au sansa de a se asigura ca oferta facuta se aliniaza cu solicitarile clientului, avand optiunea de a accepta, refuza sau modifica oferta factuta inainte de a da confirmarea finala.</p>
    		</div>
    	</div>
    </div>
</div>

<div class="bg-white shadow">
	<div class="w-full max-w-2xl mx-auto py-10 md:py-20 px-6">
		<div class="flex flex-col md:flex-row">
			<div class="flex-1 md:w-1/3 leading-normal md:mx-8">
				<div class="text-grey-darkest text-2xl md:font-bold mb-4">Clientii si furnizorii isi acorda <span class="text-indigo">calificative</span></div> 
				<p class="text-grey-darker opacity-50 text-lg  mb-6">
        			Dupa inchiderea solicitarii clientului (un furnizor a fost selectat, iar acesta a confirmat oferta), atat clientul cat si furnizorul is vor putea acorda calificative reciproc. Astfel, viitorii clienti vor putea lua o decizie mai informata cu privire la acel furnizor, in functie de calificativele acestuia.
    			</p>
    			<p class="text-grey-darker text-lg">Furniorii, la randul lor, vor putea verifica calificativele clientilor si vor putea lua o decizie mai buna atunci cand vor sa depuna oferte.</p>
    		</div>

    		<div class="flex-1 md:w-2/3 md:mx-8 mt-8 md:mt-0 flex items-center justify-center">
    			<img src="https://via.placeholder.com/640x400" class="shadow-lg rounded-lg">
    		</div>
    	</div>
    </div>
</div>

<div class="last-projects container mx-auto w-full flex-1">

	<main class="flex-1 sm:px-3 lg:px-0 pb-10 pt-8 md:pt-16">
		
		<div class="card bg-white sm:rounded shadow-md sm:shadow-lg">

			<!-- <div class="lg:hidden bg-blue-dark h-1"></div> -->

			<div class="card-header p-6 lg:p-8 border-b lg:border-grey-lighter bg-grey-lightest flex items-center justify-between">
				
				<span class="text-xl font-semibold md:text-2xl leading-normal text-blue-darker">Ultimele anunturi adaugate</span>
				
			</div> <!-- end .card-header -->

			<div class="card-body">

				@each('partials.project', $projects, 'project', 'partials.no-project')

			</div> <!-- end .card-body -->

			<div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-center"> 
				<a href="{{ route('search.show') }}" class="btn btn-grey-secondary">mai multe anunturi</a>
			</div>

		</div> <!-- and .card -->

	</main>

</div>
@endsection
