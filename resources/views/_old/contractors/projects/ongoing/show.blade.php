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

    <h2 class="p-4 border-bottom bg-light">Termenii propusi</h2>

    <div class="p-4">
        
        <div class="d-flex w-100 border-bottom pb-4 mb-4">
                
            <div class="w-25 pr-3">
                <p class="m-0 font-weight-bold">Durata de executie</p>
                {{-- <small class="text-muted">Luati in calcul orice intarzieri care ar putea apare pe parcurs.</small> --}}
            </div>

            <div class="w-75 d-flex align-items-center">
                
                <div class="form-group m-0 flex-grow-1">
    
                    <p class="lead m-0">{{ $proposal->duration }} <small class="text-muted">{{config('settings.duration_type')[$proposal->duration_type]}}</small></p>

                </div>

            </div>

        </div>

        <div class="d-flex w-100 border-bottom pb-4 mb-4">
            
            <div class="w-25 pr-3">
                <p class="m-0 font-weight-bold">Pretul</p>
                <small class="text-muted">Estimarea de pret ofertata pentru acest proiect.</small>
            </div>

            <div class="w-75 d-flex align-items-center">
                
                <div class="form-group m-0 flex-grow-1">

                     <p class="lead m-0">{{ number_format($proposal->price, 0) }} <small class="text-muted">lei</small></p>

                </div>

            </div>

        </div>


        <div class="d-flex w-100 border-bottom pb-4 mb-4">
            
            <div class="w-25 pr-4">
                <p class="m-0 font-weight-bold">Disponibil din</p>
                <small class="text-muted">Data la care veti incepe executarea proiectului.</small>
            </div>

            <div class="w-75 d-flex align-items-center">

                <p class="lead m-0">{{ $proposal->start_date->toFormattedDateString() }} <small class="text-muted">(in {{ Carbon\Carbon::now()->diffInDays($proposal->start_date) }} zile)</small></p>

            </div>

        </div>

        <div class="d-flex w-100 border-bottom pb-4 mb-4">
            
            <div class="w-25 pr-4">

                <p class="m-0 font-weight-bold">Propunerea ta</p>
                <small class="text-muted">Detalierea ofertei tale</small>
            </div>

            <div class="w-75 d-flex align-items-center">
                
                <div class="form-group flex-grow-1 m-0">
                    
                    {!! nl2br(e($proposal->description)) !!}

                </div>

            </div>

        </div>

        <div class="d-flex w-100">
            
            <div class="w-25">
                <p class="font-weight-bold m-0">Atasamente</p>
                <small class="text-muted">Fisierele si documentele atasate ofertei.</small>
            </div>

            <div class="w-75">
                
                <div class="d-flex flex-wrap justify-content-start">
                
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=1">
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=2">
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=3">
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=4">
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/arch?v=5">
                    
                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@section('right-sidebar')
    <div class="col-3 sticky">

        <div class="top-sidebar pb-5">
            
            <a href="{{ route('contractor-ongoing-projects.index') }}">Inapoi la proiecte</a>

        </div>
        
        <ul  class="list-unstyled">
            
            <li class="py-2">
                
                <a href="{{ route('contractor-feedback.create', $project->id) }}" class="btn btn-lg btn-primary">Acorda calificativ</a>
                
            </li>

            

        </ul>

        <div class="pt-5">
            <p class="font-weight-bold">Ceva meta data pentru acest proiect</p>

            <p>Data publicarii proiectului</p>

            <p>Data acceptarii</p>

            <p>Calificativ obtinut</p>
        </div>

        <div class="pt-5">

            

        </div>

    </div>

    
@endsection