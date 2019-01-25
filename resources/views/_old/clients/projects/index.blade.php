@extends('layouts.main')

@section('page-nav')
<div class="page-nav border-b bg-grey-lightest">

	<page-nav v-cloak>
	   	
	   	<page-nav-item :selected="true" name="active">
	   		Anunturi active ({{ $projects->where('published', 1)->count() }})
	   	</page-nav-item>
		
		<page-nav-item name="finalizate">
	   		Finalizate ({{ $projects->where('completed', 1)->count() }})
	   	</page-nav-item>

		<page-nav-item name="ciorne">
	   		Ciorne ({{ $projects->where('published', 0)->count() }})
	   	</page-nav-item>

	</page-nav>

</div>
@endsection

@section('main-content')
<div class="p-0 lg:p-6 xl:flex">
	
	<div class="p-6 flex flex-1">
	
		<projects-tab :hidden="false" name="active" v-cloak>
			@component('clients.projects.components.projects-list', [
				'type' => 'published',
				'title' => 'Anunturi active',
				'projects' => $projects->where('published', 1),
			])
			@endcomponent
		</projects-tab>

		<projects-tab name="finalizate" v-cloak>
			@component('clients.projects.components.projects-list', [
				'type' => 'finalized',
				'no_projects' => 'Nu aveti proiecte finalizate.',
				'title' => 'Proiecte finalizate',
				'projects' => $projects->where('completed', 1),
			])
			@endcomponent
		</projects-tab>

		<projects-tab name="ciorne" v-cloak>
			@component('clients.projects.components.projects-list', [
				'type' => 'drafts',
				'no_projects' => 'Nu aveti proiecte nepublicate.',
				'title' => 'Proiecte nepublicate',
				'projects' => $projects->where('published', 0),
			])
			@endcomponent
		</projects-tab>
		<!-- pagination goes here -->

	</div>

</div>

@endsection