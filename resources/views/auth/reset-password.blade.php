<x-guest-layout>
    <x-slot name="title">Reset Password - ARCH</x-slot>

    <div x-data="{ show: false }"
         x-init="show = true"
         x-show="show"
         x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 translate-x-12" {{-- Dari kanan --}}
         x-transition:enter-end="opacity-100 translate-x-0"
         class="flex flex-col md:flex-row bg-brand-card-bg rounded-2xl shadow-xl overflow-hidden">

        {{-- Kolom Form (Kiri) --}}
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
            
            <div class="mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="ARCH Logo" class="h-10">
            </div>

            <h2 class="text-3xl font-bold text-brand-brown mb-2 font-fredoka">Reset your password</h2>
            <p class="text-gray-600 mb-6 font-fredoka">
                Enter your new password below.
            </p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                {{-- Password Reset Token --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email Address --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-brand-brown" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" class="bg-gray-100" readonly />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password" :value="__('Password')" class="text-brand-brown" />
                    <div class="relative">
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" x-bind:type="show ? 'text' : 'password'" />
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

                {{-- Confirm Password --}}
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-brand-brown" />
                    <div class="relative">
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" x-bind:type="show ? 'text' : 'password'" />
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
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex justify-center mt-6">
                    <x-primary-button>
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="font-medium text-brand-brown hover:text-opacity-80 underline">
                    &larr; Back to Login
                </a>
            </div>
        </div>

        <div class="hidden md:flex md:w-1/2 bg-register-image bg-cover bg-center p-12 flex-col justify-end relative"
            <h1 class="relative text-white font-orator text-4xl font-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                YOUR JOURNAL BEGINS HERE!
            </h1>
        </div>
    </div>
</x-guest-layout>