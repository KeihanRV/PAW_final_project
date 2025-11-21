<x-app-layout title="Soon">
 <div class="relative flex flex-col items-center justify-center min-h-screen bg-brand-card-bg">

        <div class="flex flex-col items-center">
            
            <div class="flex items-center gap-4 text-3xl font-orator text-brand-brown tracking-widest">
                <!-- <span class="text-3xl font-orator text-brand-brown tracking-widest">WELCOME, TO</span>
                 -->
                <img src="{{ asset('images/logo.png') }}" alt="ARCH Logo" class="h-15">
            </div>
            <div class="flex text-center font-orator text-brand-brown mt-6">
                <h1>
                    Sorry Mate, Keihan, Syatira, and Cheren<br>
                    Haven't working on this one yet! <br>
                    Please, come back later
                </h1>
            </div>
            <div class="py-6">
                <a href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-custom-button>
                        GO BACK TO DASHBOARD
                    </x-custom-button>
                </a>
            </div>
        </div>

        <div class="absolute bottom-10">
            <p class="text-sm font-orator text-brand-brown opacity-75">
                CREATED BY 
                
                <span class="font-bold opacity-100">KELOMPOK 9</span>
            </p>
        </div>

    </div>
</x-app-layout>