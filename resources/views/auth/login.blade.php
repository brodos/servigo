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
                            
            <span class="font-bold text-lg leading-normal text-indigo-dark uppercase">{{ __('auth.authentication') }}</span>
            
        </div> <!-- end .card-header -->

        <div class="card-body p-6 lg:p-8">
            
            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="w-full">

                    <label class="block font-bold text-sm text-indigo-darker mb-2" for="email">{{ __('auth.email') }}</label>

                    <input type="email" id="email" name="email" class="font-bold w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-tight text-grey-darkest" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <p class="has-error text-sm mt-1 text-red-dark">{{ $errors->first('email') }}</p>
                    @endif
                    
                </div>

                <div class="mt-6">

                    <label class="block font-bold text-sm text-indigo-darker mb-2" for="password">{{ __('auth.password') }}</label>

                    <input type="password" id="password" name="password" class="font-bold w-full focus:outline-none appearance-none p-4 bg-grey-lighter rounded leading-tight text-grey-darkest" required>

                    @if ($errors->has('password'))
                        <p class="has-error text-sm mt-1 text-red-dark">{{ $errors->first('password') }}</p>
                    @endif
                    
                </div>

                <div class="mt-6">
                    <label class="block text-grey-darker flex items-center">
                        <input class="mr-2" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="text-sm">{{ __('auth.remember') }}</span>
                    </label>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="w-full btn btn-indigo">{{ __('auth.login') }}</button>
                </div>
                
            </form>
        </div> {{-- end .card-body --}}

        <div class="card-footer bg-grey-lightest p-8 border-t border-grey-lighter flex items-center justify-between text-sm"> 
            
            <a href="{{ route('register') }}" class="font-bold text-indigo-dark no-underline hover:text-indigo-darker">{{ __('auth.register') }}</a>
            <a href="{{ route('password.request') }}" class="text-grey-darker hover:text-black no-underline">{{ __('auth.forgot') }}</a>
            
        </div>

    </div>
</div>
@endsection