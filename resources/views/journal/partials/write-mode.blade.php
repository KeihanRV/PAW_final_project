@php
    $isEdit = isset($journal);
    $actionUrl = $isEdit ? route('journal.update', $journal->id) : route('journal.store');
    
    $defaultTitle = $isEdit ? $journal->title : '';
    $defaultDate = $isEdit ? ($journal->journal_date ? $journal->journal_date->format('Y-m-d') : $journal->created_at->format('Y-m-d')) : date('Y-m-d');
    $defaultTags = $isEdit ? json_encode($journal->tags) : '[]';
@endphp

<form id="journal-form-{{ $pageTarget }}" enctype="multipart/form-data" class="h-full flex flex-col relative">
    @csrf
    @if($isEdit) @method('PUT') @endif
    
    @if($isEdit)
        <button type="button" onclick="window.location.reload()" class="absolute -top-10 right-0 text-xs font-orator text-[#4A3B32] underline hover:text-red-600">
            Cancel
        </button>
    @endif

    <div class="flex justify-between items-start mb-4 border-b border-[#4A3B32]/30 pb-2 shrink-0">
        <input type="text" name="title" value="{{ $defaultTitle }}" placeholder="Title..." class="bg-transparent border-none text-3xl md:text-4xl font-reenie text-[#4A3B32] focus:ring-0 placeholder-[#4A3B32]/30 w-full">
        
        <div class="flex flex-col items-end min-w-[140px]">
            <input type="date" name="journal_date" value="{{ $defaultDate }}" 
                class="bg-transparent border-none text-right font-reenie text-lg text-[#4A3B32] focus:ring-0 p-0 mb-1 cursor-pointer">
            
            <div id="tags-container-{{ $pageTarget }}" class="flex flex-wrap gap-1 justify-end"></div>
            <input type="text" id="tag-input-{{ $pageTarget }}" placeholder="+ Tag" class="text-right bg-transparent border-none text-xs font-orator focus:ring-0 w-20">
            <input type="hidden" name="tags" id="tags-hidden-{{ $pageTarget }}" value="{{ $defaultTags }}">
        </div>
    </div>

    <div id="content-area-{{ $pageTarget }}" class="flex-1 overflow-y-auto no-scrollbar pb-4 space-y-4">
        
        @if($isEdit && !empty($journal->content))
            @foreach($journal->content as $key => $item)
                @php $index = $key . time(); @endphp
                
                @if(isset($item['type']) && $item['type'] === 'text')
                    <div class="section-item group relative mb-6 p-2 hover:bg-black/5 rounded transition-colors w-full">
                        <button type="button" onclick="this.closest('.section-item').remove()" class="absolute -right-4 -top-2 w-6 h-6 bg-red-400 text-white rounded-full flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow-sm cursor-pointer">✕</button>
                        <textarea name="content[{{ $index }}][value]" rows="1" oninput="autoResize(this)" class="w-full bg-transparent border-none p-0 font-reenie text-2xl leading-relaxed text-justify focus:ring-0 resize-none text-[#4A3B32] overflow-hidden" style="min-height: 80px;">{{ $item['value'] }}</textarea>
                        <input type="hidden" name="content[{{ $index }}][type]" value="text">
                    </div>
                @elseif(isset($item['type']) && $item['type'] === 'image')
                    <div class="section-item group relative mb-8 mt-4 w-full">
                        <button type="button" onclick="this.closest('.section-item').remove()" class="absolute -right-4 -top-3 w-8 h-8 bg-[#4A3B32] text-[#EBE2D1] rounded-full flex items-center justify-center text-sm opacity-0 group-hover:opacity-100 transition-opacity z-20 shadow-sm cursor-pointer">✕</button>
                        
                        <div class="w-full aspect-video bg-[#b0a89e] flex items-center justify-center relative cursor-pointer overflow-hidden border border-[#4A3B32]/20 shadow-inner" onclick="this.querySelector('input[type=file]').click()">
                            <img src="{{ asset('storage/' . $item['src']) }}" class="w-full h-full object-cover absolute inset-0 z-10">
                            <input type="file" name="images[]" onchange="previewImage(this)" class="hidden" accept="image/*">
                        </div>
                        
                        <input type="hidden" name="content[{{ $index }}][type]" value="image">
                        <input type="hidden" name="content[{{ $index }}][existing_src]" value="{{ $item['src'] }}">

                        <div class="mt-2 border-b border-[#4A3B32]/30 pb-1 w-full">
                            <input type="text" name="content[{{ $index }}][caption]" value="{{ $item['caption'] ?? '' }}" placeholder="description..." class="w-full bg-transparent border-none text-center font-reenie text-lg focus:ring-0 p-0 text-[#4A3B32]">
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="group relative p-2 hover:bg-black/5 rounded transition-colors w-full">
                <textarea name="content[0][value]" rows="1" placeholder="Start writing here..." oninput="autoResize(this)" class="w-full bg-transparent border-none p-0 font-reenie text-2xl leading-relaxed text-justify focus:ring-0 resize-none text-[#4A3B32] placeholder-[#4A3B32]/30 overflow-hidden" style="min-height: 80px;"></textarea>
                <input type="hidden" name="content[0][type]" value="text">
            </div>
        @endif

    </div>

    <div class="mt-auto pt-4 border-t border-[#4A3B32]/30 flex flex-col items-center gap-2 shrink-0">
        @include('components.medium-adder', ['targetId' => 'content-area-'.$pageTarget])

        <button type="button" onclick="saveJournalAJAX('{{ $pageTarget }}', '{{ $actionUrl }}')" id="btn-save-{{ $pageTarget }}" class="w-12 h-12 rounded-full border border-[#4A3B32] bg-transparent hover:bg-[#4A3B32] hover:text-[#EBE2D1] flex items-center justify-center transition-all shadow-sm group relative" title="Save Journal">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
            
            <div id="loading-{{ $pageTarget }}" class="hidden absolute inset-0 flex items-center justify-center bg-[#EBE2D1] rounded-full">
                <svg class="animate-spin h-5 w-5 text-[#4A3B32]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            </div>
        </button>
        <span id="status-msg-{{ $pageTarget }}" class="text-[10px] font-orator text-[#4A3B32] h-4"></span>
    </div>
</form>

<script>
    // Tag Logic (Scope Local per Form ID)
    (function(){
        const tagInput = document.getElementById('tag-input-{{ $pageTarget }}');
        const tagsContainer = document.getElementById('tags-container-{{ $pageTarget }}');
        const tagsHidden = document.getElementById('tags-hidden-{{ $pageTarget }}');
        let tags = [];

        try { tags = JSON.parse(tagsHidden.value); } catch(e) { tags = []; }
        renderTags();

        tagInput.addEventListener('keydown', function(e) {
            if(e.key === 'Enter') {
                e.preventDefault();
                const val = tagInput.value.trim();
                if(val && !tags.includes(val)) {
                    tags.push(val);
                    renderTags();
                    tagInput.value = '';
                }
            }
        });

        function renderTags() {
            tagsContainer.innerHTML = '';
            tags.forEach(tag => {
                const el = document.createElement('span');
                el.className = 'bg-[#dcd0bc] px-2 py-0.5 rounded text-[10px] font-orator uppercase cursor-pointer';
                el.innerText = tag;
                el.onclick = () => { tags = tags.filter(t => t !== tag); renderTags(); };
                tagsContainer.appendChild(el);
            });
            tagsHidden.value = JSON.stringify(tags);
        }
    })();
</script>