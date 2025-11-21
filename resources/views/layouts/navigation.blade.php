<nav x-data="{ open: false }" class="bg-brand-cream">
    <!-- 
        WRAPPER: 
        Kita pindahkan border ke sini dengan mx-4 
        supaya garisnya tidak mentok ke ujung layar (Sesuai request desainmu)
    -->
    <div class="mx-4 border-b-2 border-brand-brown">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20"> <!-- Tinggi h-20 biar lega -->
                
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="ARCH" class="h-12 w-auto">
                        </a>
                    </div>

                    <!-- Navigation Links (Desktop) -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <x-nav-link :href="route('journal')" :active="request()->routeIs('journal')">
                            {{ __('Journal') }}
                        </x-nav-link>
                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                            {{ __('About Us') }}
                        </x-nav-link>
                        
                    </div>
                </div>

                <!-- Settings Dropdown (Kanan) -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-brand-brown bg-transparent hover:text-opacity-75 focus:outline-none transition ease-in-out duration-150 font-orator uppercase tracking-widest">
                                <div>{{ Str::before(Auth::user()->name,' ' )}}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-brand-cream border-2 border-brand-brown rounded-lg p-2 min-w-[100px]">
                                
                                <x-dropdown-link :href="route('profile.edit')" class="mb-4">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                        class="w-full block px-4 py-2 text-center text-sm font-orator font-bold text-white bg-red-600 hover:bg-red-700 focus:outline-none transition duration-150 ease-in-out rounded-xl uppercase tracking-widest shadow-md hover:shadow-lg">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                                
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger (Mobile Trigger) -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-brand-brown hover:bg-brand-brown hover:text-brand-cream focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-brand-cream border-b border-brand-brown">
        <div class="pt-2 pb-3 space-y-1">
            
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-orator text-brand-brown uppercase">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <!-- Journal Mobile Link -->
            <x-responsive-nav-link :href="route('journal')" :active="request()->routeIs('journal')" class="font-orator text-brand-brown uppercase">
                {{ __('Journal') }}
            </x-responsive-nav-link>
            
        </div>

        <div class="pt-4 pb-1 border-t border-brand-brown/20">
            <div class="px-4">
                <div class="font-orator font-bold text-base text-brand-brown uppercase">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-brand-brown/70">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')" class="font-orator text-brand-brown uppercase text-center mb-2">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center px-4 py-2 bg-red-600 text-white font-orator uppercase rounded-lg">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>