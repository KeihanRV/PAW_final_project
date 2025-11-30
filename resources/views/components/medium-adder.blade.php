<div class="flex items-center gap-2 relative group w-full justify-center">
    
    <button type="button" onclick="toggleMenu(this)" class="medium-btn w-8 h-8 rounded-full border border-[#4A3B32]/30 text-[#4A3B32]/50 hover:border-[#4A3B32] hover:text-[#4A3B32] flex items-center justify-center transition-all duration-300 z-20 bg-[#EBE2D1]">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </button>

    <div class="medium-menu hidden absolute left-1/2 -translate-x-1/2 bottom-10 bg-gray-900 text-white rounded-md shadow-lg flex items-center p-1 gap-1 z-30 animate-fade-in-scale">
        
        <button type="button" onclick="addElement('text', '{{ $targetId }}')" class="p-2 hover:bg-gray-700 rounded transition-colors" title="Add Text">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" /></svg>
        </button>

        <button type="button" onclick="addElement('image', '{{ $targetId }}')" class="p-2 hover:bg-gray-700 rounded transition-colors" title="Add Image">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
        </button>

    </div>
</div>

<style>
    @keyframes fadeInScale { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
    .animate-fade-in-scale { animation: fadeInScale 0.2s ease-out forwards; }
</style>