<x-app-layout title="Your Journal">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orator+Std&family=Reenie+Beanie&display=swap');
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="min-h-screen w-full bg-[#dcdcdc] flex flex-col items-center py-10 font-sans overflow-y-auto">
        
        <div class="relative w-[90vw] max-w-[14400px] min-h-[850px] aspect-[16/10] flex items-center justify-center mb-10">
            
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

                    // --- LOGIKA NOMOR HALAMAN ---
                    $currentPage = $journals->currentPage(); // Halaman pagination saat ini (1, 2, 3...)
                    // Hitung nomor halaman buku (1 view = 2 halaman)
                    $leftPageNum = ($currentPage - 1) * 2 + 1; 
                    $rightPageNum = $leftPageNum + 1;
                @endphp

                <div class="w-full md:w-1/2 h-1/2 md:h-full p-8 md:p-16 border-b md:border-b-0 md:border-r border-[#4A3B32]/10 relative flex flex-col">
                    @if($leftJournal)
                        <div id="journal-wrapper-{{ $leftJournal->id }}" class="h-full w-full relative">
                            <div id="read-view-{{ $leftJournal->id }}" class="h-full w-full">
                                @include('journal.partials.read-mode', ['journal' => $leftJournal])
                            </div>
                            <div id="edit-view-{{ $leftJournal->id }}" class="h-full w-full hidden">
                                @include('journal.partials.write-mode', ['journal' => $leftJournal, 'pageTarget' => 'edit-'.$leftJournal->id])
                            </div>
                        </div>
                    @else
                        @include('journal.partials.write-mode', ['pageTarget' => 'new-left'])
                    @endif

                    <div class="absolute bottom-4 w-full text-center left-0 font-orator text-[#4A3B32] opacity-50 text-sm pointer-events-none">
                        {{ $leftPageNum }}
                    </div>
                </div>

                <div class="w-full md:w-1/2 h-1/2 md:h-full p-8 md:p-16 relative flex flex-col bg-[#eaddcf]">
                    @if($rightJournal)
                        <div id="journal-wrapper-{{ $rightJournal->id }}" class="h-full w-full relative">
                            <div id="read-view-{{ $rightJournal->id }}" class="h-full w-full">
                                @include('journal.partials.read-mode', ['journal' => $rightJournal])
                            </div>
                            <div id="edit-view-{{ $rightJournal->id }}" class="h-full w-full hidden">
                                @include('journal.partials.write-mode', ['journal' => $rightJournal, 'pageTarget' => 'edit-'.$rightJournal->id])
                            </div>
                        </div>
                    @elseif($leftJournal) 
                        @include('journal.partials.write-mode', ['pageTarget' => 'new-right'])
                    @else
                        <div class="flex-1 flex items-center justify-center opacity-30 font-orator select-none text-xl tracking-widest">Empty Page</div>
                    @endif

                    <div class="absolute bottom-4 w-full text-center left-0 font-orator text-[#4A3B32] opacity-50 text-sm pointer-events-none">
                        {{ $rightPageNum }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function autoResize(textarea) {
            textarea.style.height = 'auto'; 
            textarea.style.height = textarea.scrollHeight + 'px';
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('textarea').forEach(el => autoResize(el));
        });

        window.addElement = function(type, containerId) {
            const container = document.getElementById(containerId);
            if (!container) return;

            const index = Date.now() + Math.floor(Math.random() * 1000); 
            let html = '';

            if (type === 'text') {
                html = `
                <div class="section-item group relative mb-6 p-2 hover:bg-black/5 rounded transition-colors w-full">
                    <button type="button" onclick="this.closest('.section-item').remove()" class="absolute -right-4 -top-2 w-6 h-6 bg-red-400 text-white rounded-full flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow-sm cursor-pointer">✕</button>
                    
                    <textarea name="content[${index}][value]" rows="1" placeholder="Write something..." 
                        oninput="autoResize(this)"
                        class="w-full bg-transparent border-none p-0 font-reenie text-2xl leading-relaxed text-justify focus:ring-0 resize-none text-[#4A3B32] placeholder-[#4A3B32]/30 overflow-hidden"
                        style="min-height: 80px;"></textarea>
                    
                    <input type="hidden" name="content[${index}][type]" value="text">
                </div>`;
            } 
            else if (type === 'image') {
                html = `
                <div class="section-item group relative mb-8 mt-4 w-full">
                    <button type="button" onclick="this.closest('.section-item').remove()" class="absolute -right-4 -top-3 w-8 h-8 bg-[#4A3B32] text-[#EBE2D1] rounded-full flex items-center justify-center text-sm opacity-0 group-hover:opacity-100 transition-opacity z-20 shadow-md cursor-pointer">✕</button>

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
            
            if (type === 'text') {
                const newTextarea = container.lastElementChild.querySelector('textarea');
                if(newTextarea) newTextarea.focus();
            }

            const form = container.closest('form');
            form.querySelectorAll('.medium-menu').forEach(el => el.classList.add('hidden'));
            form.querySelectorAll('.medium-btn').forEach(el => el.classList.remove('rotate-45', 'bg-[#4A3B32]', 'text-[#EBE2D1]'));
        };

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

        window.toggleDropdown = function(id) {
            const dropdown = document.getElementById(id);
            const isHidden = dropdown.classList.contains('hidden');
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => el.classList.add('hidden'));
            if(isHidden) dropdown.classList.remove('hidden');
        }

        window.switchMode = function(journalId) {
            document.getElementById('read-view-' + journalId).classList.add('hidden');
            document.getElementById('edit-view-' + journalId).classList.remove('hidden');
            document.getElementById('dropdown-' + journalId).classList.add('hidden');
            
            setTimeout(() => {
                document.querySelectorAll('#journal-form-edit-' + journalId + ' textarea').forEach(el => autoResize(el));
            }, 100);
        }

        window.saveJournalAJAX = async function(targetId, url) {
            const form = document.getElementById('journal-form-' + targetId);
            const btn = document.getElementById('btn-save-' + targetId);
            const loading = document.getElementById('loading-' + targetId);
            const statusMsg = document.getElementById('status-msg-' + targetId);

            const tagInput = document.getElementById('tag-input-' + targetId);
            const tagsHidden = document.getElementById('tags-hidden-' + targetId);
            if (tagInput && tagInput.value.trim() !== "") {
                let currentTags = [];
                try { currentTags = JSON.parse(tagsHidden.value || "[]"); } catch(e) { currentTags = []; }
                const newTag = tagInput.value.trim();
                if (!currentTags.includes(newTag)) {
                    currentTags.push(newTag);
                    tagsHidden.value = JSON.stringify(currentTags);
                }
            }

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
                const response = await fetch(url, {
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
    </script>
</x-app-layout>