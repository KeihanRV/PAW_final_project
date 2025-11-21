@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? 'ARCH - ' . $title : 'ARCH - Website' }}</title>
        <link rel="icon" href="{{ asset('favicon.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet" />
        <link href="https://fonts.cdnfonts.com/css/orator-std" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-6 sm:py-12 px-4 sm:px-6 lg:px-8 bg-brand-page-bg">
            
            <main class="w-full max-w-5xl mx-auto">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>