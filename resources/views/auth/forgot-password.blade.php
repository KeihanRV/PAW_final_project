<x-guest-layout>
    <x-slot name="title">ARCH - Forgot Password</x-slot>

    <div x-data="{ show: false }"
         x-init="show = true"
         x-show="show"
         x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 -translate-x-12"
         x-transition:enter-end="opacity-100 translate-x-0"
         class="flex flex-col md:flex-row bg-brand-card-bg rounded-2xl shadow-xl overflow-hidden">

        {{-- Kolom Gambar (Kiri) --}}
        <div class="hidden md:flex md:w-1/2 bg-forgot-image bg-cover bg-center p-12 flex-col justify-end relative">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <h1 class="relative text-white font-orator text-center text-3xl font-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                REMEMBER THE FORGOTTEN!
            </h1>
        </div>

        {{-- Kolom Form (Kanan) --}}
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
            
            <div class="mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="ARCH Logo" class="h-12">
            </div>

            <h2 class="text-3xl text-center text-brand-brown mb-2 font-fredoka">Forgot your password?</h2>
            <p class="text-gray-600 text-center mb-6 font-fredoka">
                Don't let people forget you like your password!
                Fill the email below to make your password remembered again!
            </p>

            <x-auth-session-status class="mb-4 font-fredoka" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email Address --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-brand-brown" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex justify-center mt-6">
                    <x-primary-button>
                        {{ __('Send Email') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="text-start mt-6">
                <a href="{{ route('login') }}" class="font-medium text-brand-brown hover:text-opacity-80 underline">
                    &larr; Back
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>