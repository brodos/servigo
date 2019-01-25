@extends('layouts.app')
@section('pageTitle', 'Contul meu')

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
					<span class="font-bold text-lg leading-normal text-indigo-dark uppercase">Profilul meu</span>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body">

			</div>

			<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection