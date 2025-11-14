<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARCH - Dashboard</title>

    <link rel="icon" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Orator+Std&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-brand-cream min-h-screen">
    
    <!-- Navigation Header -->
    <nav class="bg-brand-cream text-brand-brown p-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}" alt="ARCH Logo" class="h-10">
                <h1 class="text-2xl font-orator font-bold text-brand-brown">Dashboard</h1>
            </div>
            <div class="flex items-center gap-4">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-brand-brown hover:opacity-90 text-brand-cream rounded transition duration-300">
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        
        <!-- Admin Dashboard Button -->
        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="mb-8">
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-block px-6 py-3 bg-brand-cream hover:opacity-90 text-brand-brown font-semibold rounded-lg transition duration-300">
                    Go to Admin Dashboard
                </a>
            </div>
        @endif

        <!-- Welcome Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-brand-cream to-white p-8 text-brand-brown">
                <h2 class="text-4xl font-orator font-bold mb-2">Welcome To ARCH!</h2>
                <p class="text-lg opacity-90">You're successfully logged in to ARCH</p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- User Info Card -->
                    <div class="bg-brand-cream rounded-lg p-6 border-2 border-brand-brown">
                        <h3 class="text-lg font-semibold text-brand-brown mb-4">Your Profile</h3>
                        <p class="text-gray-700 mb-2"><strong>Name:</strong> {{ auth()->user()->name }}</p>
                        <p class="text-gray-700 mb-2"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p class="text-gray-700 mb-4"><strong>Role:</strong> 
                            <span class="inline-block px-3 py-1 bg-brand-brown text-brand-cream rounded-full text-sm font-semibold capitalize">
                                {{ auth()->user()->role }}
                            </span>
                        </p>
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-block px-4 py-2 bg-brand-brown hover:opacity-90 text-brand-cream font-semibold rounded transition duration-300">
                            Edit Profile
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-brand-cream rounded-lg p-6 border-2 border-brand-brown">
                        <h3 class="text-lg font-semibold text-brand-brown mb-4">Account Status</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Status:</span>
                                <span class="px-3 py-1 bg-green-500 text-white rounded-full text-sm font-semibold">Active</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Email Verified:</span>
                                <span class="px-3 py-1 bg-green-500 text-white rounded-full text-sm font-semibold">Yes</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Member Since:</span>
                                <span class="text-gray-700 text-sm">{{ auth()->user()->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Links -->
                    <div class="bg-brand-cream rounded-lg p-6 border-2 border-brand-brown">
                        <h3 class="text-lg font-semibold text-brand-brown mb-4">Quick Actions</h3>
                        <div class="space-y-2">
                            <a href="{{ route('profile.edit') }}" 
                               class="block px-4 py-2 text-center bg-brand-brown hover:opacity-90 text-brand-cream font-semibold rounded transition duration-300">
                                Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <!-- <button type="submit" 
                                        class="w-full px-4 py-2 text-center bg-brand-brown hover:opacity-90 text-brand-cream font-semibold rounded transition duration-300">
                                    Logout
                                </button> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
