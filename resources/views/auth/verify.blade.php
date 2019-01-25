@extends('layouts.skeleton')

@section('page')
<div class="h-2 bg-indigo-dark"></div>

<div class="logo w-full lg:w-auto flex items-center justify-center my-4 sm:my-10">
    <a href="{{ route('home') }}" class="no-underline text-indigo-darker text-5xl tracking-tight">
        servigo
    </a>
</div>

<div class="mx-3 sm:mx-auto sm:max-w-sm mb-4 sm:mb-10">
    <div class="card rounded bg-white shadow-lg">
        
        <div class="card-header p-6 lg:p-8 border-b lg:border-grey-lighter flex items-center justify-center">
                            
            <span class="font-bold text-lg leading-normal text-indigo-dark uppercase">Confirma adresa de email</span>
            
        </div> <!-- end .card-header -->

        <div class="card-body p-6 lg:p-8">

            @if (session('resent'))
                <div class="bg-green-lightest border-l-4 border-green p-6 text-green-darker rounded leading-normal" role="alert">
                    Un nou link de confirmare a fost trimis pe adresa ta de email.
                </div>
            @else
                <div class="text-grey-darkest leading-normal">
                    <p class="mb-6">Pentru a putea continua, trebuie mai intai sa iti confirmi adresa de email.</p>
                    <p>Verifica-ti email-ul si da click pe butonul <em>"{{ __('Verify Email Address') }}"</em>.</p>
                </div>
            @endif
            
        </div> {{-- end .card-body --}}

        @unless (session('resent'))
            <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-center "> 
                
                <a href="{{ route('verification.resend') }}" class="font-bold text-indigo-dark no-underline hover:text-indigo-darker">Retrimite link-ul de confirmare</a>
                
            </div>
        @endunless
    </div>
</div>
@endsection