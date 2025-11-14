<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARCH - Welcome</title>

    <link rel="icon" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Orator+Std&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <div class="relative flex flex-col items-center justify-center min-h-screen bg-brand-card-bg">

        <div class="flex flex-col items-center">
            
            <div class="flex items-center gap-4">
                <span class="text-3xl font-orator text-brand-brown tracking-widest">WELCOME, TO</span>
                
                <img src="{{ asset('images/logo.png') }}" alt="ARCH Logo" class="h-15">
            </div>
            <div class="flex text-center font-orator">
                <p>The place where your
                    <span class = "font-bold"> Journey</span>
                    begins!
                </p>

            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-10">
                
                <a href="{{ route('register') }}" 
                class="px-10 py-3 bg-brand-brown text-brand-cream font-orator font-semibold rounded-lg shadow-md 
                        border border-brand-brown 
                        hover:bg-brand-card-bg hover:text-brand-brown transition duration-300 text-center">
                    SIGN UP
                </a>
                
                <a href="{{ route('login') }}" 
                class="px-10 py-3 bg-brand-cream text-brand-brown font-orator font-semibold rounded-lg shadow-md 
                        border border-brand-brown 
                        hover:bg-brand-brown hover:text-brand-cream transition duration-300 text-center">
                    SIGN IN
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