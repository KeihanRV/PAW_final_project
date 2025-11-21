@props(['title', 'image' => '', 'description' => '', 'continent' => '', 'date' => ''])

<div x-data="{ expanded: false }" 
     class="postcard-entry opacity-0 translate-y-10 transition-all duration-1000 ease-out relative group w-full">

    <div x-show="!expanded" 
         @click="expanded = true"
         class="flex flex-col items-center w-full cursor-pointer">
        
        <div class="bg-white p-3 shadow-md border border-brand-brown/10 transition duration-300 ease-in-out group-hover:-translate-y-2 w-full rounded-sm">
            
            <div class="aspect-[4/3] bg-white max-h-[250px] w-full overflow-hidden">
                @if($image)
                    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-brand-brown/30 bg-brand-brown/5 font-orator">NO IMAGE</div>
                @endif
            </div>

            <p class="mt-4 text-3xl font-reenie text-brand-brown underline decoration-brand-brown/50 underline-offset-4 text-center">
                {{ $title }}
            </p>
        </div>
    </div>


    <div x-show="expanded" 
         @click="expanded = false"
         style="display: none;"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 -translate-y-10"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-10"
         
         /* PERUBAHAN DISINI: */
         /* 1. Hapus 'border-[6px] border-white' */
         /* 2. Tambahkan 'p-3' agar sama persis dengan tampilan normal */
         class="relative w-full bg-white p-3 shadow-2xl rounded-sm flex flex-col cursor-pointer hover:shadow-xl transition-shadow">
        
        <div class="w-full max-h-[250px] md:h-48 relative shrink-0">
            <img src="{{ $image }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-transparent h-20 pointer-events-none"></div>
        </div>

        <div class="pt-3 pb-0 px-0 text-center bg-white">
            
            <h3 class="text-3xl font-reenie text-brand-brown mb-4 relative inline-block">
                {{ $title }}
                <div class="absolute -bottom-1 left-0 w-full h-0.5 bg-brand-brown/20 rounded-full"></div>
            </h3>

            <div class="relative border-2 border-brand-brown/80 p-6 w-full mt-2 bg-white/50">
                <p class="text-2xl font-reenie text-brand-brown leading-relaxed text-justify md:text-center select-none">
                    {{ $description }}
                </p>
            </div>
            
            <!-- <div class="mt-4 text-brand-brown/40 font-orator text-[10px] uppercase tracking-widest">
                (Click anywhere to close)
            </div> -->

        </div>
    </div>

</div>