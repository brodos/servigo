@extends('layouts.skeleton')

@section('page')
<div class="h-2 bg-indigo-dark"></div>

<div class="logo w-full lg:w-auto flex items-center justify-center my-4 sm:my-10">
    <a href="{{ route('home') }}" class="no-underline text-indigo-darker text-5xl tracking-tight">
        servigo
    </a>
</div>
<div class="mx-3 sm:mx-auto sm:max-w-sm mb-12">
    
    <div class="card rounded bg-white shadow-lg">
        
        <div class="card-header p-6 lg:p-8 border-b lg:border-grey-lighter flex items-center justify-center">
                            
            <span class="font-bold text-lg leading-normal text-indigo-dark uppercase">Resetează parola</span>
            
        </div> <!-- end .card-header -->

        <div class="card-body p-6 lg:p-8">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="w-full">

                    <label class="block font-bold text-sm text-indigo-darker mb-2" for="email">Email</label>

                    <input type="email" id="email" name="email" class="font-bold w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-tight text-grey-darkest" value="{{ $email ?? old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <p class="has-error text-sm mt-1 text-red-dark">{{ $errors->first('email') }}</p>
                    @endif
                    
                </div>

                <div class="mt-6">

                    <label class="block font-bold text-sm text-indigo-darker mb-2" for="password">Parola</label>

                    <input type="password" id="password" name="password" class="font-bold w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-tight text-grey-darkest" required>

                    @if ($errors->has('password'))
                        <p class="has-error text-sm mt-1 text-red-dark">{{ $errors->first('password') }}</p>
                    @endif
                    
                </div>

                <div class="mt-6">

                    <label class="block font-bold text-sm text-indigo-darker mb-2" for="password_confirmation">Confirmare parolă</label>

                    <input type="password" id="password_confirmation" name="password_confirmation" class="font-bold w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-tight text-grey-darkest" required>

                    @if ($errors->has('password_confirmation'))
                        <p class="has-error text-sm mt-1 text-red-dark">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                    
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="w-full btn btn-indigo">Resetează parola</button>
                </div>
                
            </form>

        </div> {{-- end .card-body --}}

        <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-center text-sm"> 
            
            <a href="{{ route('login') }}" class="font-bold text-indigo-dark no-underline hover:text-indigo-darker">Ti-ai amintit parola?</a>
            
        </div>

    </div>
</div>
@endsection