<x-app-layout title="Write Journal">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orator+Std&family=Reenie+Beanie&display=swap');
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .fade-enter { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="min-h-screen bg-[#2c241b] flex items-center justify-center p-2 md:p-8 font-sans">

        <form action="{{ route('journal.store') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-7xl">
            @csrf

            <div class="bg-brand-cream w-full min-h-[850px] rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden border-r-[12px] border-b-[12px] border-[#3e3226] relative">
                
                <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-12 -ml-6 bg-gradient-to-r from-black/5 via-transparent to-black/5 z-20 pointer-events-none border-l border-r border-black/5"></div>

                <div class="w-full md:w-1/2 h-full p-6 md:p-12 border-b md:border-b-0 md:border-r border-brand-brown/10 relative flex flex-col">
                    
                    <div class="flex justify-between items-start mb-8 font-reenie text-2xl text-brand-brown/80 relative z-10">
                        <span class="mt-1">{{ now()->format('D, d M Y') }}</span>
                        
                        <div class="flex flex-col items-end max-w-[60%]">
                            <div id="tags-container" class="flex flex-wrap gap-2 justify-end mb-2"></div>
                            <input type="text" id="tag-input" placeholder="+ Tag" 
                                class="bg-transparent border-b border-brand-brown/30 text-right w-20 focus:w-auto min-w-[80px] focus:outline-none font-orator text-sm text-brand-brown placeholder-brand-brown/30 transition-all">
                            <input type="hidden" name="tags" id="tags-hidden">
                        </div>
                    </div>

                    <input type="text" name="title" placeholder="Title..." 
                        class="w-full bg-transparent border-none text-5xl font-reenie text-brand-brown focus:ring-0 placeholder-brand-brown/20 mb-8 p-0">

                    <div id="left-page-content" class="space-y-6 flex-1 overflow-y-auto no-scrollbar pb-10">
                        <div class="group relative hover:bg-black/5 p-2 rounded transition-colors duration-300">
                            <textarea name="content[0][value]" rows="3" placeholder="Tell your story..." 
                                class="w-full bg-transparent border-none p-0 font-reenie text-2xl leading-relaxed text-justify focus:ring-0 resize-none text-brand-brown placeholder-brand-brown/30"></textarea>
                            <input type="hidden" name="content[0][type]" value="text">
                        </div>
                    </div>

                    <div class="mt-4 border-t border-brand-brown/10 pt-4">
                        @include('components.medium-adder', ['targetId' => 'left-page-content'])
                    </div>
                </div>

                <div class="w-full md:w-1/2 h-full p-6 md:p-12 relative flex flex-col bg-[#eaddcf]">
                    
                    <div id="right-page-content" class="space-y-6 flex-1 overflow-y-auto no-scrollbar pb-10">
                         <div class="text-brand-brown/30 font-orator text-sm text-center py-10 border-2 border-dashed border-brand-brown/10 rounded-lg select-none">
                            Continue writing here...
                        </div>
                    </div>

                    <div class="mt-4 border-t border-brand-brown/10 pt-4 mb-8">
                        @include('components.medium-adder', ['targetId' => 'right-page-content'])
                    </div>

                    <div class="mt-auto flex justify-end">
                        <button type="submit" class="bg-brand-brown text-brand-cream font-orator tracking-widest px-10 py-3 rounded-sm shadow-lg hover:bg-[#3a2e26] transition-all transform hover:-translate-y-1 active:translate-y-0">
                            SAVE JOURNAL
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        function toggleMenu(btn) {
            const menu = btn.nextElementSibling;
            const isOpen = !menu.classList.contains('hidden');
            document.querySelectorAll('.medium-menu').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.medium-btn').forEach(el => el.classList.remove('rotate-45', 'bg-brand-brown', 'text-brand-cream'));

            if (!isOpen) {
                menu.classList.remove('hidden');
                btn.classList.add('rotate-45', 'bg-brand-brown', 'text-brand-cream');
            }
        }

        function removeSection(btn) {
            if(confirm('Delete this section?')) {
                btn.closest('.section-item').remove();
            }
        }

        function addElement(type, containerId) {
            const container = document.getElementById(containerId);

            if(containerId === 'right-page-content') {
                const placeholder = container.querySelector('.border-dashed');
                if(placeholder) placeholder.remove();
            }

            const index = Date.now() + Math.floor(Math.random() * 1000);
            let html = '';
            
            if (type === 'text') {
                html = `
                <div class="section-item group relative fade-enter mb-4 hover:bg-black/5 p-2 rounded transition-colors duration-300">
                    <button type="button" onclick="removeSection(this)" class="absolute -right-2 -top-2 w-6 h-6 bg-red-400 text-white rounded-full flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity z-10 shadow-sm" title="Remove section">✕</button>
                    
                    <textarea name="content[${index}][value]" rows="3" placeholder="Write something..." 
                        class="w-full bg-transparent border-none p-0 font-reenie text-2xl leading-relaxed text-justify focus:ring-0 resize-none text-brand-brown placeholder-brand-brown/30"></textarea>
                    <input type="hidden" name="content[${index}][type]" value="text">
                </div>`;
            } 
            else if (type === 'image') {
                html = `
                <div class="section-item group relative fade-enter mb-8 mt-6">
                    <button type="button" onclick="removeSection(this)" class="absolute -right-3 -top-3 w-8 h-8 bg-brand-brown text-brand-cream rounded-full flex items-center justify-center text-sm opacity-0 group-hover:opacity-100 transition-opacity z-20 shadow-md border border-brand-cream">✕</button>

                    <div class="w-full aspect-video bg-[#b0a89e] flex items-center justify-center relative cursor-pointer overflow-hidden border border-brand-brown/20 shadow-inner group-hover:border-brand-brown transition-colors" onclick="this.querySelector('input[type=file]').click()">
                        <div class="text-brand-brown/40 flex flex-col items-center placeholder-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16 mb-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span class="font-orator text-xs">Click to upload image</span>
                        </div>
                        <img src="" class="hidden w-full h-full object-cover absolute inset-0 z-10">
                        <input type="file" name="images[]" onchange="previewImageNew(this)" class="hidden" accept="image/*">
                    </div>
                    
                    <input type="hidden" name="content[${index}][type]" value="image">

                    <div class="mt-4 border border-brand-brown rounded px-4 py-3 bg-brand-cream/50 w-full">
                        <input type="text" name="content[${index}][caption]" placeholder="write the description" class="w-full bg-transparent border-none text-center font-reenie text-xl focus:ring-0 p-0 text-brand-brown placeholder-brand-brown/40">
                    </div>
                </div>`;
            }

            container.insertAdjacentHTML('beforeend', html);
            
            document.querySelectorAll('.medium-menu').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.medium-btn').forEach(el => el.classList.remove('rotate-45', 'bg-brand-brown', 'text-brand-cream'));
        }

        function previewImageNew(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const parent = input.closest('div'); 
                    const img = parent.querySelector('img');
                    const icon = parent.querySelector('.placeholder-icon');
                    
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                    icon.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        const tagInput = document.getElementById('tag-input');
        const tagsContainer = document.getElementById('tags-container');
        const tagsHidden = document.getElementById('tags-hidden');
        let tags = [];

        tagInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const val = tagInput.value.trim();
                if (val && !tags.includes(val)) {
                    tags.push(val);
                    renderTags();
                    tagInput.value = '';
                }
            }
        });

        function renderTags() {
            tagsContainer.innerHTML = '';
            tags.forEach(tag => {
                const tagEl = document.createElement('span');
                tagEl.className = 'inline-flex items-center bg-brand-brown text-brand-cream px-3 py-1 rounded-full text-xs font-orator cursor-pointer hover:bg-red-800 transition-colors shadow-sm whitespace-nowrap';
                tagEl.innerText = tag;
                tagEl.onclick = () => { tags = tags.filter(t => t !== tag); renderTags(); };
                tagsContainer.appendChild(tagEl);
            });
            tagsHidden.value = JSON.stringify(tags);
        }
    </script>
</x-app-layout>