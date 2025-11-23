<footer class="bg-brand-brown text-brand-cream font-orator border-t-4 border-brand-cream/20 mt-auto">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row py-6 items-start">
            
            <div class="md:w-1/4 flex flex-col justify-start items-start mb-8 md:mb-0">
                <img src="{{ asset('images/logo-light.png') }}" alt="ARCH" class="h-24 w-auto">
            </div>

            <div class="md:w-1/4 md:border-l-2 border-brand-cream/30 md:pl-8 flex flex-col gap-6 mb-8 md:mb-0">
                
                <x-footer-link :href="route('dashboard')">
                    Dashboard
                </x-footer-link>

                <x-footer-link :href="route('journal')">
                    Journal
                </x-footer-link>

                <x-footer-link :href="route('about')">
                    About Us
                </x-footer-link>

            </div>

            <div class="hidden md:block md:w-1/12"></div>

            <div class="md:w-1/2 md:border-l-2 border-brand-cream/30 md:pl-8">
                <h3 class="text-lg font-bold uppercase tracking-widest mb-6">
                    Kelompok 9
                </h3>
                <ul class="space-y-3 text-sm font-orator uppercase tracking-widest opacity-90">
                    <li>Cheren Agatha Devona Syallom</li>
                    <li>Keihan Radja Vasya</li>
                    <li>Syatira Zulaikanisa</li>
                </ul>
            </div>
        </div>

        <div class="border-t-2 border-brand-cream/30 py-6 mt-4">
            <div class="flex flex-col md:flex-row gap-4 md:gap-0 text-sm md:text-s uppercase tracking-widest opacity-70 font-orator">
                
                <div class="md:pr-6 md:border-r-2 border-brand-cream/30">
                    Final Project For Pemrograman Web
                </div>
                
                <div class="md:px-6 md:border-r-2 border-brand-cream/30">
                    Information Technology
                </div>
                
                <div class="md:pl-6">
                    Brawijaya University
                </div>

            </div>
        </div>

    </div>
</footer>