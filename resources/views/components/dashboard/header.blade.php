<div class="min-h-[calc(100vh-5rem)] flex flex-col justify-center items-center text-center relative mb-12">
    
    <div class="z-10">
        <h2 class="text-2xl md:text-3xl font-orator font-bold text-brand-brown uppercase tracking-widest mb-8 leading-tight">
            Welcome, <br>
            <span class="text-brand-brown-hover">{{ Auth::user()->name }}</span>
        </h2>

        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" 
               class="inline-block px-10 py-3 border-2 border-brand-brown rounded-full text-brand-brown font-orator text-sm font-bold uppercase tracking-widest hover:bg-brand-brown hover:text-brand-cream transition duration-300">
                Admin Dashboard
            </a>
        @endif
    </div>

    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-8 h-8 text-brand-brown opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>

</div>