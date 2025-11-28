<div class="h-full flex flex-col relative group/page">
    
    <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this page?');" 
          class="absolute -right-2 -top-2 z-20 opacity-0 group-hover/page:opacity-100 transition-opacity duration-300">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-8 h-8 bg-red-800 text-white rounded-full flex items-center justify-center shadow-md hover:bg-red-600 transition-colors" title="Delete Page">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </button>
    </form>

    <div class="flex justify-between items-start mb-4 border-b border-[#4A3B32] pb-2 shrink-0">
        <h2 class="font-reenie text-3xl md:text-4xl text-[#4A3B32] truncate max-w-[60%]">{{ $journal->title }}</h2>
        <div class="text-right">
            <div class="font-reenie text-sm mb-1 text-[#4A3B32]">
                {{ $journal->journal_date ? $journal->journal_date->format('D, d M Y') : $journal->created_at->format('D, d M Y') }}
            </div>
            <div class="flex flex-wrap gap-1 justify-end">
                @foreach($journal->tags ?? [] as $tag)
                    <span class="bg-[#dcd0bc] px-2 py-0.5 rounded-md text-[10px] font-orator text-[#4A3B32] uppercase">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto no-scrollbar space-y-4 text-[#4A3B32] pr-2">
        @foreach($journal->content ?? [] as $item)
            @if(isset($item['type']) && $item['type'] === 'text')
                <p class="font-reenie text-xl md:text-2xl leading-relaxed text-justify whitespace-pre-line">
                    {{ $item['value'] }}
                </p>
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