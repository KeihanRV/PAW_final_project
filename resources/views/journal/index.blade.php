<x-app-layout title="Your Journal">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orator+Std&family=Reenie+Beanie&display=swap');
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="min-h-screen w-full bg-[#dcdcdc] flex flex-col items-center py-10 font-sans overflow-y-auto">
        
        <h1 class="font-orator m-4 text-3xl md:text-3xl text-brand-brown font-bold tracking-[0.3em] uppercase mb-8 text-center shrink-0 select-none">
            Y O U R &nbsp; J O U R N A L
        </h1>

        <div class="relative w-[88vw] max-w-[1440px] min-h-[850px] aspect-[16/10] flex items-center justify-center mb-10">
            
            @if(!$journals->onFirstPage())
                <a href="{{ $journals->previousPageUrl() }}" class="absolute -left-2 md:-left-12 top-1/2 -translate-y-1/2 z-50 w-12 h-12 rounded-full border-2 border-[#4A3B32] flex items-center justify-center hover:bg-[#4A3B32] hover:text-[#EBE2D1] transition-colors bg-[#dcdcdc] shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                </a>
            @endif

            <a href="{{ $journals->nextPageUrl() ?? request()->fullUrlWithQuery(['page' => $journals->lastPage() + 1]) }}" class="absolute -right-2 md:-right-12 top-1/2 -translate-y-1/2 z-50 w-12 h-12 rounded-full border-2 border-[#4A3B32] flex items-center justify-center hover:bg-[#4A3B32] hover:text-[#EBE2D1] transition-colors bg-[#dcdcdc] shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
            </a>

            <div class="bg-[#EBE2D1] w-full h-full rounded-r-3xl rounded-l-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden border-r-[12px] border-b-[12px] border-[#3e3226] relative">
                
                <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-10 -ml-5 bg-gradient-to-r from-black/5 via-transparent to-black/5 z-20 pointer-events-none border-l border-r border-black/5"></div>

                @php
                    $leftJournal = $journals[0] ?? null;
                    $rightJournal = $journals[1] ?? null;
                @endphp

                <div class="w-full md:w-1/2 h-1/2 md:h-full p-8 md:p-16 border-b md:border-b-0 md:border-r border-[#4A3B32]/10 relative flex flex-col">
                    @if($leftJournal)
                        @include('journal.partials.read-mode', ['journal' => $leftJournal])
                    @else
                        @include('journal.partials.write-mode', ['pageTarget' => $journals->currentPage()])
                    @endif
                </div>

                <div class="w-full md:w-1/2 h-1/2 md:h-full p-8 md:p-16 relative flex flex-col bg-[#eaddcf]">
                    @if($rightJournal)
                        @include('journal.partials.read-mode', ['journal' => $rightJournal])
                    @elseif($leftJournal) 
                        @include('journal.partials.write-mode', ['pageTarget' => $journals->currentPage()])
                    @else
                        <div class="flex-1 flex items-center justify-center opacity-30 font-orator select-none text-xl tracking-widest">Empty Page</div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>