<x-app-layout title="Dashboard">
    
    <div class="bg-brand-cream min-h-screen pb-24 relative">
        
        <div class="max-w-6xl mx-auto px-6 lg:px-8"> 
            
            <x-dashboard.header />

            @if($postcards->isEmpty())
                
                <div class="mt-12 text-center"> 
                    <x-dashboard.section-title>
                        Latest Collection
                    </x-dashboard.section-title>
                </div>

                <div class="mt-16 text-center py-12">
                    <p class="font-reenie text-4xl text-brand-brown opacity-60">
                        No postcards have been written yet...
                    </p>
                </div>

            @else

                @foreach($postcards->groupBy('continent') as $continent => $items)
                    
                    <div class="mb-24">
                        
                        <div class="mt-12 text-center"> 
                            <x-dashboard.section-title>
                                {{ $continent }}
                            </x-dashboard.section-title>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-16 px-4 mt-16 items-start">
                            
                            @foreach($items as $postcard)
                                <div class="{{ $loop->iteration % 2 == 0 ? 'delay-200' : '' }} w-full">
                                    
                                    <x-dashboard.card 
                                        :title="$postcard->city . ' - ' . $postcard->country" 
                                        :image="asset($postcard->image)"
                                        :description="$postcard->description"
                                        :continent="$postcard->continent"
                                        :date="$postcard->created_at->format('F d, Y')"
                                    />

                                </div>
                            @endforeach

                        </div>

                    </div>
                    
                @endforeach

            @endif

        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.postcard-entry').forEach(el => observer.observe(el));
        });
    </script>

</x-app-layout>