<x-guest-layout title="Login">
    <div class="flex flex-col md:flex-row bg-brand-cream rounded-2xl shadow-xl overflow-hidden">

        <div class="hidden md:flex md:w-1/2 bg-login-image bg-cover bg-center p-12 flex-col justify-end relative">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <h1 class="relative text-brand-cream font-orator text-4xl font-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                WRITE YOUR LIFE!
            </h1>
        </div>

        <div class="w-full md:w-1/2 p-8 sm:p-12">
            
            <div class="mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="ARCH Logo" class="h-12"> 
            </div>

            <h2 class="text-3xl text-center text-brand-brown mb-2">Login</h2>
            <p class="text-brand-brown text-center mb-6">Fill your data below</p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-brand-brown" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password" :value="__('Password')" class="text-brand-brown" />
                    
                    <div class="relative">
                        <x-text-input id="password" class="block mt-1 w-full"
                                        x-bind:type="show ? 'text' : 'password'"
                                        name="password"
                                        required autocomplete="current-password" />
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-brand-cream">
                            <svg x-show="!show" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.774 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243L12 12" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                    
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-brand-brown underline hover:text-opacity-80 rounded-md focus:outline-none" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex justify-center mt-6">
                    <x-primary-button>
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-medium text-brand-brown hover:text-brand-brown underline">
                            Sign up
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>