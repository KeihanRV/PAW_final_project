<div class="h-full flex flex-col relative group/page">
    
    <div class="flex justify-between items-start mb-4 border-b border-[#4A3B32] pb-2 shrink-0">
        
        <h2 class="font-reenie text-3xl md:text-4xl text-[#4A3B32] truncate max-w-[65%]">{{ $journal->title }}</h2>
        
        <div class="text-right flex flex-col items-end">
            
            <div class="flex items-center gap-2 relative">
                <div class="font-reenie text-sm text-[#4A3B32]">
                    {{ $journal->journal_date ? $journal->journal_date->format('D, d M Y') : $journal->created_at->format('D, d M Y') }}
                </div>

                <button onclick="toggleDropdown('dropdown-{{ $journal->id }}')" class="text-[#4A3B32] hover:bg-[#4A3B32]/10 rounded-full p-1 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                    </svg>
                </button>

                <div id="dropdown-{{ $journal->id }}" class="hidden absolute right-0 top-6 bg-white border border-[#4A3B32]/20 shadow-lg rounded-md w-32 z-50 overflow-hidden font-orator text-xs">
                    <button onclick="switchMode('{{ $journal->id }}')" class="w-full text-left px-4 py-2 hover:bg-[#EBE2D1] text-[#4A3B32] flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                        Edit
                    </button>
                    
                    <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Delete this page?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600 flex items-center gap-2 border-t border-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="flex flex-wrap gap-1 justify-end mt-1">
                @foreach($journal->tags ?? [] as $tag)
                    <span class="bg-[#dcd0bc] px-2 py-0.5 rounded-md text-[10px] font-orator text-[#4A3B32] uppercase">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto no-scrollbar space-y-4 text-[#4A3B32] pr-2">
        @foreach($journal->content ?? [] as $item)
            @if(isset($item['type']) && $item['type'] === 'text')
                <p class="font-reenie text-xl md:text-2xl leading-relaxed text-justify whitespace-pre-line">{{ $item['value'] }}</p>
            @elseif(isset($item['type']) && $item['type'] === 'image')
                <div class="w-full mt-2 mb-4">
                    <img src="{{ asset('storage/' . $item['src']) }}" class="w-full h-auto object-cover border-4 border-white shadow-sm">
                    @if(!empty($item['caption']))
                        <p class="text-center font-reenie text-lg mt-1 opacity-70 border-b border-[#4A3B32]/10 pb-1">{{ $item['caption'] }}</p>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</div>

<script>
    // Fungsi Toggle Dropdown
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const isHidden = dropdown.classList.contains('hidden');
        
        // Tutup semua dropdown lain
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));

        if(isHidden) dropdown.classList.remove('hidden');
        else dropdown.classList.add('hidden');
    }

    // Fungsi Ganti Mode (Baca -> Tulis)
    function switchMode(journalId) {
        document.getElementById('read-view-' + journalId).classList.add('hidden');
        document.getElementById('edit-view-' + journalId).classList.remove('hidden');
        // Tutup dropdown
        document.getElementById('dropdown-' + journalId).classList.add('hidden');
    }
</script>