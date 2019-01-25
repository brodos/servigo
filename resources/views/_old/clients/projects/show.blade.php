@extends('layouts.main')

@section('page-nav')

<div class="page-nav border-b bg-grey-lightest">

    <div class="bg-grey-lightest p-10 text-black font-bold text-2xl opacity-75">{{ $project->name }}</div>

    <page-nav v-cloak>
        
        <page-nav-item :selected="true" name="active">
            Oferte <span class="text-green">({{ $project->proposals_count }})</span>
        </page-nav-item>
        
        <page-nav-item name="messages" class="relative">
            Mesaje <span class="text-green">({{ $project->messages_count }})</span> 
        </page-nav-item>

        <page-nav-item name="promote">
            Promovare
        </page-nav-item>

        <page-nav-item name="project">
            Anunt
        </page-nav-item>

    </page-nav>

</div>
@endsection

@section('main-content')

<div class="p-0 lg:px-6 xl:flex justify-center">
    
    <div class="p-6 flex xl:w-3/4">
        
        <projects-tab :hidden="false" name="active" v-cloak>

            @include('clients.projects.partials.proposals')

        </projects-tab>


        <projects-tab :hidden="true" name="messages" v-cloak>

            @include('clients.projects.partials.messages')

        </projects-tab>


        <projects-tab :hidden="true" name="project" v-cloak>

            @include('clients.projects.partials.project')

        </projects-tab>


        <projects-tab :hidden="true" name="promote" v-cloak>

            @include('clients.projects.partials.promote')

        </projects-tab>

    </div>

    <div class="hidden xl:flex p-6 xl:mt-6 xl:ml-6 xl:w-1/4 bg-white rounded shadow-lg">right</div>

</div>
@endsection

@section ('content')

<div class="h2 py-4">{{ $project->name }}</div>

<ul class="pb-4 nav nav-pills nav-fill" role="tablist">
    <li class="nav-item">
        <a class="nav-link " id="details-tab" data-toggle="pill" href="#details" role="tab" aria-controls="details-tab" aria-selected="false">
            Detalii proiect
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="proposals-tab" data-toggle="pill" href="#proposals" role="tab" aria-controls="proposals-tab" aria-selected="false">
            Oferte primite <span class="badge @if ($project->unread_proposals_count > 0) badge-danger @else badge-secondary @endif">{{ $project->unread_proposals_count > 0  ? $project->unread_proposals_count : $project->proposals_count }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" id="messages-tab" data-toggle="pill" href="#messages" role="tab" aria-controls="messages-tab" aria-selected="true">
            Mesaje <span class="badge @if ($project->unread_messages_count > 0) badge-danger @else badge-secondary @endif">{{ $project->unread_messages_count ?? $project->messages_count }}</span>
        </a>
    </li>
    @if ($project->isOngoing || $project->isCompleted)
        <li class="nav-item">
            <a class="nav-link" id="feedback-tab" data-toggle="pill" href="#feedback" role="tab" aria-controls="feedback-tab" aria-selected="false">
                Feedback <span class="badge badge-secondary">0</span>
            </a>
        </li>
    @endif
    @if ($project->isActive)
    <li class="nav-item">
        <a class="nav-link" id="promote-tab" data-toggle="pill" href="#promote" role="tab" aria-controls="promote-tab" aria-selected="false">
            Promovare
        </a>
    </li>
    @endif
</ul>

<div class="tab-content mb-5">

    <div class="tab-pane fade shadow bg-white rounded " id="details" role="tabpanel" aria-labelledby="home-tab">

    	

    </div>

    <div class="tab-pane fade shadow bg-white rounded " id="proposals" role="tabpanel" aria-labelledby="proposals-tab">
        
        @include('clients.projects.partials.proposals')

    </div>
    <div class="tab-pane fade shadow bg-white rounded show active " id="messages" role="tabpanel" aria-labelledby="messages-tab">
        
        @include('clients.projects.partials.messages')

    </div>
    
    @if ($project->isOngoing  || $project->isCompleted)
        <div class="tab-pane fade bg-light" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
            
            @include('clients.projects.partials.feedback')

        </div>
    @endif

    @if ($project->isActive)
        <div class="tab-pane fade shadow bg-white rounded" id="promote" role="tabpanel" aria-labelledby="promote-tab">
            
            <div class="d-flex justify-content-center align-items-center p-4 border-bottom bg-light text-black-50">
                <h2 class="flex-fill mb-0">Promovare proiect</h2>

                <div class="flex-fill text-right align-self-start">
                    
                    

                </div>
            </div>

            <div class="project-content p-5">

                <div class="pre-wrap text-justify">detalii despre posibilitatile de promovare</div>

            </div>

        </div>
    @endif
</div>

@endsection

@section('right-sidebar')
    <div class="col-3 pt-5 sticky">
        
        <ul  class="list-unstyled">
            
            <li class="py-2">
                <a href="#">Previzualizare</a>
            </li>

            <li class="py-2">
                <a href="{{ route('client-projects.edit', $project) }}">Modifica</a>
            </li>

            <li class="py-2">
                <a href="#">Sterge </a>
            </li>

            <li class="py-2">
                <a href="#">Creaza copie</a>
            </li>

            <li class="py-2">
                <a href="#">Make private</a>
            </li>

        </ul>

    </div>
@endsection