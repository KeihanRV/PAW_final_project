<form id="journal-form-{{ $pageTarget }}" enctype="multipart/form-data" class="h-full flex flex-col relative">
    @csrf
    
    <div class="flex justify-between items-start mb-4 border-b border-[#4A3B32]/30 pb-2 shrink-0">
        <input type="text" name="title" placeholder="Title..." class="bg-transparent border-none text-3xl md:text-4xl font-reenie text-[#4A3B32] focus:ring-0 placeholder-[#4A3B32]/30 w-full">
        
        <div class="flex flex-col items-end min-w-[140px]">
            <input type="date" name="journal_date" value="{{ date('Y-m-d') }}" 
                class="bg-transparent border-none text-right font-reenie text-lg text-[#4A3B32] focus:ring-0 p-0 mb-1 cursor-pointer">
            
            <div id="tags-container-{{ $pageTarget }}" class="flex flex-wrap gap-1 justify-end"></div>
            <input type="text" id="tag-input-{{ $pageTarget }}" placeholder="+ Tag" class="text-right bg-transparent border-none text-xs font-orator focus:ring-0 w-20">
            <input type="hidden" name="tags" id="tags-hidden-{{ $pageTarget }}">
        </div>
    </div>

    <div id="content-area-{{ $pageTarget }}" class="flex-1 overflow-y-auto no-scrollbar pb-4 space-y-4">
        
        <div class="group relative p-2 hover:bg-black/5 rounded transition-colors">
            <textarea name="content[0][value]" rows="1" placeholder="Start writing here..." 
                oninput="autoResize(this)"
                class="w-full bg-transparent border-none p-0 font-reenie text-2xl leading-relaxed text-justify focus:ring-0 resize-none text-[#4A3B32] placeholder-[#4A3B32]/30 overflow-hidden" 
                style="min-height: 50px;"></textarea>
            <input type="hidden" name="content[0][type]" value="text">
        </div>

    </div>

    <div class="mt-auto pt-4 border-t border-[#4A3B32]/30 flex flex-col items-center gap-2 shrink-0">
        
        @include('components.medium-adder', ['targetId' => 'content-area-'.$pageTarget])

        <button type="button" onclick="saveJournalAJAX('{{ $pageTarget }}')" id="btn-save-{{ $pageTarget }}" class="w-12 h-12 rounded-full border border-[#4A3B32] bg-transparent hover:bg-[#4A3B32] hover:text-[#EBE2D1] flex items-center justify-center transition-all shadow-sm group relative" title="Save Journal">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:scale-110 transition-transform"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
            <div id="loading-{{ $pageTarget }}" class="hidden absolute inset-0 flex items-center justify-center bg-[#EBE2D1] rounded-full">
                <svg class="animate-spin h-5 w-5 text-[#4A3B32]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            </div>
        </button>
        <span id="status-msg-{{ $pageTarget }}" class="text-[10px] font-orator text-[#4A3B32] h-4"></span>
    </div>
</form>

<script>

    // 1. Auto Resize Textarea
    window.autoResize = function(textarea) {
        textarea.style.height = 'auto'; // Reset
        textarea.style.height = textarea.scrollHeight + 'px'; // Expand
    }

    // 2. Add Element (Text/Image)
    window.addElement = function(type, containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;

        const index = Date.now() + Math.floor(Math.random() * 1000); 
        let html = '';

        if (type === 'text') {
            html = `
            <div class="section-item group relative mb-4 p-2 hover:bg-black/5 rounded transition-colors">
                <button type="button" onclick="this.closest('.section-item').remove()" class="absolute -right-2 -top-2 w-6 h-6 bg-red-400 text-white rounded-full flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow-sm cursor-pointer">✕</button>
                
                <textarea name="content[${index}][value]" rows="1" placeholder="Write something..." 
                    oninput="autoResize(this)"
                    class="w-full bg-transparent border-none p-0 font-reenie text-2xl leading-relaxed text-justify focus:ring-0 resize-none text-[#4A3B32] placeholder-[#4A3B32]/30 overflow-hidden"
                    style="min-height: 50px;"></textarea>
                
                <input type="hidden" name="content[${index}][type]" value="text">
            </div>`;
        } 
        else if (type === 'image') {
            html = `
            <div class="section-item group relative mb-6 mt-4">
                <button type="button" onclick="this.closest('.section-item').remove()" class="absolute -right-3 -top-3 w-8 h-8 bg-[#4A3B32] text-[#EBE2D1] rounded-full flex items-center justify-center text-sm opacity-0 group-hover:opacity-100 transition-opacity z-20 shadow-md cursor-pointer">✕</button>

                <div class="w-full aspect-video bg-[#b0a89e] flex items-center justify-center relative cursor-pointer overflow-hidden border border-[#4A3B32]/20 shadow-inner group-hover:border-[#4A3B32] transition-colors" onclick="this.querySelector('input[type=file]').click()">
                    
                    <div class="text-[#4A3B32]/40 flex flex-col items-center placeholder-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 mb-2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                        <span class="font-orator text-[10px]">Upload Image</span>
                    </div>

                    <img src="" class="hidden w-full h-full object-cover absolute inset-0 z-10 pointer-events-none">
                    <input type="file" name="images[]" onchange="previewImage(this)" class="hidden" accept="image/*">
                </div>
                
                <input type="hidden" name="content[${index}][type]" value="image">

                <div class="mt-2 border-b border-[#4A3B32]/30 pb-1 w-full">
                    <input type="text" name="content[${index}][caption]" placeholder="write the description..." class="w-full bg-transparent border-none text-center font-reenie text-lg focus:ring-0 p-0 text-[#4A3B32] placeholder-[#4A3B32]/40">
                </div>
            </div>`;
        }

        container.insertAdjacentHTML('beforeend', html);
        
        // Auto focus jika text
        if (type === 'text') {
            const newTextarea = container.lastElementChild.querySelector('textarea');
            if(newTextarea) newTextarea.focus();
        }

        // Close Menu
        const form = container.closest('form');
        form.querySelectorAll('.medium-menu').forEach(el => el.classList.add('hidden'));
        form.querySelectorAll('.medium-btn').forEach(el => el.classList.remove('rotate-45', 'bg-[#4A3B32]', 'text-[#EBE2D1]'));
    }

    // 3. Preview Image
    window.previewImage = function(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const parent = input.parentElement;
                const img = parent.querySelector('img');
                const icon = parent.querySelector('.placeholder-icon');
                img.src = e.target.result;
                img.classList.remove('hidden');
                icon.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 4. Toggle Menu
    window.toggleMenu = function(btn) {
        const menu = btn.nextElementSibling;
        const isOpen = !menu.classList.contains('hidden');
        const form = btn.closest('form');
        
        form.querySelectorAll('.medium-menu').forEach(el => el.classList.add('hidden'));
        form.querySelectorAll('.medium-btn').forEach(el => el.classList.remove('rotate-45', 'bg-[#4A3B32]', 'text-[#EBE2D1]'));

        if (!isOpen) {
            menu.classList.remove('hidden');
            btn.classList.add('rotate-45', 'bg-[#4A3B32]', 'text-[#EBE2D1]');
        }
    }

    // 5. AJAX Save
    async function saveJournalAJAX(targetId) {
        const form = document.getElementById('journal-form-' + targetId);
        const btn = document.getElementById('btn-save-' + targetId);
        const loading = document.getElementById('loading-' + targetId);
        const statusMsg = document.getElementById('status-msg-' + targetId);

        const title = form.querySelector('input[name="title"]').value;
        if(!title) {
            statusMsg.innerText = "Title required!";
            statusMsg.classList.add('text-red-600');
            return;
        }

        loading.classList.remove('hidden');
        btn.disabled = true;
        statusMsg.innerText = "Saving...";
        statusMsg.classList.remove('text-red-600');

        try {
            const formData = new FormData(form);
            const response = await fetch("{{ route('journal.store') }}", {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
                body: formData
            });

            const result = await response.json();

            if(response.ok) {
                statusMsg.innerText = "Saved!";
                statusMsg.classList.add('text-green-700');
                setTimeout(() => window.location.reload(), 500);
            } else {
                console.error(result);
                statusMsg.innerText = result.message || "Error.";
                statusMsg.classList.add('text-red-600');
            }
        } catch (error) {
            console.error(error);
            statusMsg.innerText = "Error.";
            statusMsg.classList.add('text-red-600');
        } finally {
            loading.classList.add('hidden');
            btn.disabled = false;
        }
    }

    (function(){
        const tagInput = document.getElementById('tag-input-{{ $pageTarget }}');
        const tagsContainer = document.getElementById('tags-container-{{ $pageTarget }}');
        const tagsHidden = document.getElementById('tags-hidden-{{ $pageTarget }}');
        let tags = [];

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