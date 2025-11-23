<x-app-layout title="About Us">

    <div class="bg-brand-cream min-h-screen font-sans text-brand-brown pb-24">
        
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 md:py-20 animate-on-load opacity-0 translate-y-6 transition-all duration-700">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch mb-16">
                
                <div class="flex flex-col justify-between h-full order-1">
                        
                        <div class="mb-8 gap-4">
                        <h1 class="text-5xl font-orator font-bold uppercase leading-none tracking-widest">
                            A B O U T
                        </h1>
                        <h1 class="text-5xl font-orator font-bold uppercase leading-none tracking-widest mb-6">
                             U S
                        </h1>
                        
                        <div class="pr-0 lg:pr-8">
                            <p class="text-justify font-sans text-sm leading-relaxed opacity-90">
                                The place where your stories begin. You can write your thoughts, capture memories, and remember everything that happened in your journal. The story of who you are starts with your own action.
                                <br><br>
                                The postcard is a symbol of connection, a tangible piece of communication that bridges distances and brings people closer together. Just like our platform, postcards carry stories, emotions, and memories across time and space, reminding us of the importance of cherishing moments and relationships.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="h-full min-h-[400px] relative overflow-hidden group order-2">
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-300 text-brand-brown/50 font-orator text-center">
                        <img src="{{ asset('images/about-img.jpg') }}" alt="Sorry mate, till not available" class="w-full h-full object-cover opacity-100">
                    </div>
                </div>

                <div class="bg-brand-brown text-brand-cream p-8 md:p-12 flex flex-col items-center justify-center text-center h-full order-3 shadow-lg">
                    <div class="flex gap-1 mb-8 select-none scale-110">
                        <img src="{{ asset('images/logo-light.png') }}" alt="ARCH" class="h-18 w-auto">
                    </div>

                    <h2 class="text-2xl font-orator uppercase tracking-[0.2em] border-b-2 border-brand-cream pb-2 mb-8">
                        Our Philosophy
                    </h2>

                    <p class="font-sans text-sm md:text-base leading-relaxed tracking-wide opacity-90">
                        ARCH means archive, a place to store and preserve your thoughts, memories, and inspirations. ARCH also means leading, means you are the one who lead your own journey. When it start, and when it ended, also how people remember it.                    
                    </p>
                </div>

            </div>

            <div class="w-full h-0.5 bg-brand-brown/80 mb-16 max-w-[200px] mx-auto"></div>

            <div class="bg-[#EBE2D1] p-6 md:p-12 rounded-sm shadow-sm">
                
                <h2 class="text-center text-3xl md:text-5xl font-orator uppercase tracking-[0.2em] underline decoration-2 underline-offset-8 mb-12 text-brand-brown animate-on-scroll opacity-0 translate-y-6 transition-all duration-700">
                    Meet Our Team!
                </h2>

                <div class="w-full aspect-[21/9] md:aspect-[3/1] bg-brand-cream relative overflow-hidden mb-8 border-4 border-white shadow-md flex items-center justify-center animate-on-scroll opacity-0 translate-y-6 transition-all duration-700">
                    <img src="{{ asset('images/team-photo.png') }}" alt="Team Photo" class="w-full h-full object-cover relative z-10 opacity-100">
                </div>

                <div class="flex w-full gap-2 animate-on-scroll opacity-0 translate-y-6 transition-all duration-700">
                    
                    <div class="flex-1 flex justify-center text-center items-center">
                        <span class="font-reenie text-lg md:text-3xl text-brand-brown font-bold tracking-wide border-b-2 border-brand-brown pb-1 px-1 md:px-4">
                            Cheren Agatha D. S
                        </span>
                    </div>

                    <div class="flex-1 flex justify-center text-center items-center">
                        <span class="font-reenie text-lg md:text-3xl text-brand-brown font-bold tracking-wide border-b-2 border-brand-brown pb-1 px-1 md:px-4">
                            Keihan Radja Vasya
                        </span>
                    </div>

                    <div class="flex-1 flex justify-center text-center items-center">
                        <span class="font-reenie text-lg md:text-3xl text-brand-brown font-bold tracking-wide border-b-2 border-brand-brown pb-1 px-1 md:px-4">
                            Syatira Zulaikanisa
                        </span>
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>

<script>
    // IntersectionObserver to reveal elements with class 'animate-on-scroll'
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-6', 'translate-y-3');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        // Observe scroll-triggered elements
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Animate-on-load elements: reveal immediately with a small stagger
        const loadEls = Array.from(document.querySelectorAll('.animate-on-load'));
        loadEls.forEach((el, idx) => {
            // ensure we don't re-hide elements already visible
            setTimeout(() => {
                el.classList.remove('opacity-0', 'translate-y-6', 'translate-y-3');
                el.classList.add('opacity-100', 'translate-y-0');
            }, 100 + idx * 100);
        });
    });
</script>