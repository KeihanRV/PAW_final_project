<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARCH - Soon</title>

    <link rel="icon" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Orator+Std&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <div class="relative flex flex-col items-center justify-center min-h-screen bg-brand-card-bg">

        <div class="flex flex-col items-center">
            
            <div class="flex items-center gap-4 text-3xl font-orator text-brand-brown tracking-widest">
                <!-- <span class="text-3xl font-orator text-brand-brown tracking-widest">WELCOME, TO</span>
                 -->
                <img src="{{ asset('images/logo.png') }}" alt="ARCH Logo" class="h-15">
            </div>
            <div class="flex text-center font-orator">
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
</body>
</html>