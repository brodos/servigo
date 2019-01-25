@extends('layouts.app')

@section ('content')
    
<div class="h2 py-4">Detalii oferta</div>

@if (in_array($proposal->status, [3, 4])) 

    <div class="alert @if($proposal->status == 3) alert-info @else alert-success @endif rounded-0 py-5 mb-5" 
        style="border-top: 5px solid @if($proposal->status == 3) darkblue @else green @endif;">
        <p class="lead mb-0"><span class="font-weight-bold">Felicitati!</span> Oferta dumneavoastra a fost acceptata.</p>
        
        @if ($project->status != 4)
            <p class="lead mt-3"><span class="font-weight-bold"><u>Confirmati alocarea</u></span> proiectului sau luati legatura cu clientul pentru detalii suplimentare.</p>
        @endif
    </div>

@endif

<div class="shadow bg-white rounded mb-5">
    
    <h2 class="p-4 border-bottom bg-light mr-auto">Detalii proiect</h2>

    <div class="p-4">
        
        <h3>{{ $project->name }}</h3>
        <small class="d-block text-muted">Taguri / Data publicarii / Localitate</small>

        <div>
            {{ $project->description }}
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
            
            <a href="{{ route('contractor-proposals.index') }}">Inapoi la oferte</a>

        </div>
        
        <div>
            
            @if ($proposal->status == 3)
                <form action="{{ route('contractor-proposals.confirm', [$project->id, $proposal->id]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <p><button type="submit" class="btn btn-lg btn-success btn-block">Confirma alocarea!</button></p>
                </form>
            @endif

            <p><a href="#" class="btn btn-light btn-block">Contacteaza clientul</a></p>

        </div>

        <div class="pt-3">
            
            <p class="font-weight-bold">About the client</p>

            <p>stelute</p>

            <p>Locatie</p>

            <p class="m-0 font-weight-bold">Istoric</p>

            <ul class="list-unstyled">
                <li>12 applicants</li>
                <li>6 interviews</li>
                <li>45 jobs posted</li>
                <li>4 open jobs</li>
                <li>8 hires</li>
            </ul>

            <p class="text-muted">Member since...</p>

        </div>

        @if ($proposal->status != 4)
            <div class="p-4 border-bottom bg-light">
                <form action="" method="post">
                    <button type="submit" class="btn btn-danger btn-block">Retrage oferta</button>
                </form>
            </div>
        @endif

    </div>

    
@endsection