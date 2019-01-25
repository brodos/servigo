@extends('layouts.app')
@section('pageTitle', 'Profilul meu')

@section('mobile-top-navigation')
	@component('account.components.mobile-top-left-link', [
		'action' => 'back',
		'url' => route('user-project.index')
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

			<div class="card-header p-6 lg:py-8 lg:px-10 border-b md:border-grey-lighter bg-grey-lightest flex items-center justify-between">
				<span class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto">Profilul meu</span>
				<div>
					<a href="{{ route('user-profile.edit') }}" class="btn btn-indigo">modifică</a>
				</div>
			</div> <!-- end .card-header -->

			<div class="card-body p-6 lg:p-10">

				<div class="person flex flex-col-reverse md:flex-row items-center">

					<img class="w-16 h-16 rounded-full mr-6" src="{{ $user->avatar() }}">

					<div class="flex-1 mb-4 md:mb-0">
						<span class="text-3xl font-semibold text-grey-darkest">{{ $user->displayName }} </span>
					</div>

					<div class="mb-6 md:mb-0">
						Procent completare profil: <span class="font-bold text-indigo-dark">{{ $user->profile->completedPercentage() }}%</span>
					</div>
					
				</div>

				<div class="mt-8 leading-normal md:text-lg">
					<div class="text-grey-dark font-semibold">Localitatea</div>
					<div class="text-grey-darkest">{{ $user->profile->location }}</div>
				</div>

				<div class="mt-8 leading-normal md:text-lg">
					<div class="text-grey-dark font-semibold">Introducere</div>
					<div class="text-grey-darkest leading-tad">@if ($user->profile->tagline) {{ $user->profile->tagline }} @else <em>necompletat</em> @endif</div>
				</div>

				<div class="mt-8 leading-normal md:text-lg">
					<div class="text-grey-dark font-semibold">Prezentare</div>
					<div class="text-grey-darkest leading-tad">@if ($user->profile->bio) {{ $user->profile->bio }} @else <em>necompletat</em> @endif</div>
				</div>

				<div class="mt-8 leading-normal md:text-lg">
					<div class="text-grey-dark font-semibold">Link preferențial</div>
					<div class="text-grey-darkest leading-tad">@if($user->profile->slug_name) <a class="text-grey-darkest no-underline hover:text-blue-dark" href="{{ route('public-profile', $user->profile->slug_name) }}" target="_blank">{{ url('/p') . '/' }}<span class="text-indigo-dark font-semibold">{{ $user->profile->slug_name }}</span></a> @else <em>nespecificat</em> @endif</div>
				</div>

				<div class="mt-8 leading-normal md:text-lg">
					<div class="text-grey-dark font-semibold">Link personal</div>
					<div class="text-grey-darkest leading-tad">@if($user->profile->personal_url) <a class="text-grey-darkest no-underline hover:text-blue-dark" target="_blank" rel="nofollow" href="{{ $user->profile->personal_url }}">{{ $user->profile->personal_url }}</a> @else <em>nespecificat</em> @endif</div>
				</div>

			</div>

			<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->
	
		</div> {{-- end .card --}}

		<div class="card bg-white md:rounded md:shadow-lg mt-12">

			<div class="card-header p-6 lg:py-8 lg:px-10 border-b md:border-grey-lighter bg-grey-lightest flex items-center justify-between">
				<span class="text-xl w-full leading-normal text-indigo-darker md:font-semibold md:w-auto">Fotografii</span>
			</div> <!-- end .card-header -->

			<div class="card-body p-6 lg:p-10">

				<div class="mb-10 leading-normal md:text-lg">
					<div class="text-grey-darkest">Adăugați fotografii care pun în evidență talentul, priceperea, aptitudinile, experiența dumneavoastră.</div>
				</div>
				
				@if ($user->profile->media->isEmpty())
					<div class="leading-normal md:text-xl">
						<div class="text-grey-darker text-center font-semibold">Inca nu ați adaugat fotografii.</div>
					</div>
				@else
					<ul class="list-reset flex flex-col lg:flex-row lg:flex-wrap">
						@foreach ($user->profile->media as $media)
							<li class="w-full lg:w-1/3" ref="media-{{ $media->uuid }}">
								<a target="_blank" href="{{ $media->asset_path }}" class="inline-block w-full pb-3 sm:pb-6 lg:px-3 zoom-image">
									<image-file :delete="@can('delete_media', $media){{ 'true' }}@else{{ 'false' }}@endcan" :media="{{ $media }}"></image-file>
								</a>
							</li>
						@endforeach
					</ul>
				@endif
				
				<form action="{{ route('user-profile-media.store') }}" method="post">
					@csrf
					@method('put')
					<div class="mt-10 flex flex-col items-center justify-center">
						<image-upload :user="{{ auth()->user() }}" :uploaded="false"></image-upload>

						<div class="text-center mt-10">
							<button type="submit" class="btn btn-indigo">Salvează fotografiile</button>
						</div>
					</div>

				</form>

			</div>

			<!-- <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between"></div> -->
	
		</div> {{-- end .card --}}

	</main>

</div>
@endsection

@section('scripts')
	@parent
	<script src="{{ asset('/js/medium-lightbox.js') }}"></script>
	<script>
		(function() {
			MediumLightbox('figure.zoom-image');	
		})
	</script>
@endsection