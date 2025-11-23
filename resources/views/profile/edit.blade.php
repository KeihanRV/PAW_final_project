<x-app-layout title="Profile">
    
    <div class="min-h-screen bg-brand-cream py-8 px-4 sm:px-6 lg:px-8 font-sans text-brand-brown relative">

        <div class="absolute top-8 right-16 text-right font-orator text-sm uppercase tracking-widest opacity-80 hidden md:block">
            Join Since<br>
            {{ $user->created_at->format('d F Y') }}
        </div>

        <div class="max-w-6xl mx-auto">
            <h1 class="text-5xl font-orator font-underline font-bold text-center text-brand-brown uppercase tracking-[0.2em] mb-16">
                Profile
            </h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

            <div class="lg:col-span-1 flex justify-center">
                <div class="relative">
                    
                    <form id="avatar-form" action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="w-64 h-64 md:w-80 md:h-80 rounded-full overflow-hidden border-4 border-brand-brown/20 shadow-xl relative group">
                            
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 transition duration-500">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4A3B32&color=F2E8DC&size=512" 
                                    alt="Avatar" class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 transition duration-500">
                            @endif
                            
                            <div class="absolute inset-0 bg-brand-brown/30 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <span class="text-brand-cream font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition delay-100">Change Photo</span>
                            </div>
                        </div>

                        <input type="file" id="avatarInput" name="avatar" class="hidden" onchange="document.getElementById('avatar-form').submit()">
                    
                    </form>

                    <button onclick="document.getElementById('avatarInput').click()" 
                            class="absolute bottom-4 right-4 bg-brand-brown text-brand-cream p-3 rounded-full hover:bg-brand-brown/90 transition shadow-lg border-2 border-brand-cream group cursor-pointer z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 group-hover:scale-110 transition">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                        </svg>
                    </button>

                    @if (session('status') === 'avatar-updated')
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="absolute -bottom-12 left-0 w-full text-center">
                            <p class="text-sm text-green-700 font-bold bg-green-100 px-2 py-1 rounded shadow">Photo Updated!</p>
                        </div>
                    @endif

                    @error('avatar')
                        <div class="absolute -bottom-16 left-0 w-full text-center">
                            <p class="text-xs text-red-600 font-bold bg-red-100 px-2 py-1 rounded shadow">{{ $message }}</p>
                        </div>
                    @enderror

                </div>
            </div>

                <div class="lg:col-span-2">
                    @include('profile.partials.combined-profile-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>