@extends('layouts.app')

@section ('content')

<div class="h2 py-4">Detalii proiect</div>

<div class="shadow bg-white rounded tab-content mb-5">

	<div class="d-flex justify-content-center align-items-center p-4 border-bottom bg-white text-black-50">
        <h2 class="flex-fill mb-0">{{ $project->name }}</h2>

        <div class="flex-fill text-right align-self-start">
        
            data publicarii        

        </div>
    </div>

    <div class="project-content p-5">

        <div class="project-section pb-5">

            <p class="font-weight-bold">Descriere:</p>

            <div class="pre-wrap text-justify">{{ $project->description }}</div>

        </div>
        
        <div class="project-section pb-5">

            <p class="font-weight-bold">Cuvinte cheie:</p>

            <div class="">#rezist</div>

        </div>

        <div class="project-section pb-5">

            <p class="font-weight-bold">Fotografii:</p>

            <div class="d-flex flex-wrap justify-content-start">
                
                <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=1">
                <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=2">
                <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=3">
                <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=4">
                <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=5">
                
            </div>

        </div>

        <div class="project-section">

            <p class="font-weight-bold">Documente:</p>

            <div class="d-flex">
                
                <span>file.xls</span>

            </div>

        </div>

    </div>
    
</div>

<div class="shadow bg-white rounded mb-5">

    <div class="d-flex justify-content-center align-items-center p-4 border-bottom bg-white text-black-50">

        <h2 class="flex-fill mb-0">Istoric client</h2>        

    </div>

    <div class="flex-fill align-self-start">
        
        <div class="project-content p-5">

            <div class="project-section pb-5">

                <p class="font-weight-bold">Poriecte in lucru</p>

            </div>

            <div class="project-section">

                <p class="font-weight-bold">Poriecte finalizate</p>

            </div>

        </div>

    </div>

</div>

<div class="shadow bg-white rounded mb-5">

    <div class="d-flex justify-content-center align-items-center p-4 border-bottom bg-white text-black-50">

        <h2 class="flex-fill mb-0">Proiecte similare</h2>        

    </div>

    <div class="flex-fill align-self-start">
        
        <div class="project-content p-5">

            <div class="project-section">

                <p class="lead font-weight-bold"><a href="#">Proiect similar lorem ipsum</a></p>
                <p class="font-weight-bold"><a href="#">Proiect similar lorem ipsum</a></p>
                <p class="lead font-weight-bold"><a href="#">Proiect similar lorem ipsum</a></p>
                <p class="font-weight-bold"><a href="#">Proiect similar lorem ipsum</a></p>
                <p class="lead font-weight-bold"><a href="#">Proiect similar lorem ipsum</a></p>

            </div>

        </div>

    </div>

</div>

@endsection

@section('right-sidebar')
    <div class="col-3 sticky">

        <div class="top-sidebar pb-5">
            
            <a href="{{ url()->previous() }}">Inapoi la proiecte</a>

        </div>
        
        <ul  class="list-unstyled">
            
            <li class="py-2">
                <a href="{{ route('contractor-proposals.create', $project->id) }}">Trimite oferta</a>
            </li>

            <li class="py-2">
                <a href="#">Salvare</a>
            </li>

            <li class="py-2">
                <a href="#">Raporteaza </a>
            </li>

        </ul>

        <div class="pt-5">
            Required Connects to submit a proposal: 2 
            Available Connects: 60
        </div>

        <div class="pt-5">
            
            <p class="font-weight-bold">About the client</p>

            <p>stelute</p>

            <p>Locatie</p>

            <p>
                Proiecte publicate<br>
                <small class="text-muted">procent angajare, proiecte in lucru</small>
            </p>

            <small class="text-muted">Member since...</small>

        </div>

    </div>

    
@endsection