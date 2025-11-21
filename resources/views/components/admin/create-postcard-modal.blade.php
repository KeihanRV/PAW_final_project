<div x-data="{ createOpen: {{ $errors->any() ? 'true' : 'false' }} }">

    <button @click="createOpen = true" 
            class="fixed bottom-10 right-10 w-16 h-16 bg-brand-brown text-brand-cream rounded-full shadow-[4px_4px_0px_0px_rgba(217,209,189,0.5)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 z-40 flex items-center justify-center group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 group-hover:rotate-90 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
    </button>

    <div x-show="createOpen" 
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center bg-brand-brown/90 backdrop-blur-sm p-4 overflow-y-auto">
        
        <div @click="createOpen = false" class="absolute inset-0 cursor-pointer"></div>

        <div class="bg-brand-cream border-2 border-brand-brown p-8 md:p-10 w-full max-w-4xl relative shadow-2xl rounded-lg max-h-[90vh] overflow-y-auto">
            
            <button @click="createOpen = false" class="absolute top-4 right-4 text-brand-brown font-bold text-2xl hover:rotate-90 transition">✕</button>

            <h2 class="text-3xl font-orator font-bold text-brand-brown mb-8 text-center uppercase tracking-widest">
                Create New Postcard
            </h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 text-center font-sans">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">Please check the form inputs.</span>
                </div>
            @endif

            <form action="{{ route('admin.postcard.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="flex flex-col items-center justify-center">
                    <div class="relative">
                        <select name="continent" class="appearance-none bg-brand-cream border-2 border-brand-brown px-8 py-3 text-3xl font-reenie text-brand-brown text-center focus:outline-none cursor-pointer rounded-md min-w-[300px]">
                            <!-- <option value="" disabled selected>Select Continent</option> -->
                            <option value="Classic of Europe" {{ old('continent') == 'Classic of Europe' ? 'selected' : '' }}>Classic of Europe</option>
                            <option value="Classic of Asia" {{ old('continent') == 'Classic of Asia' ? 'selected' : '' }}>Classic of Asia</option>
                            <option value="Classic of Africa" {{ old('continent') == 'Classic of Africa' ? 'selected' : '' }}>Classic of Africa</option>
                            <option value="Classic of America" {{ old('continent') == 'Classic of America' ? 'selected' : '' }}>Classic of America</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-brand-brown">
                            <!-- <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg> -->
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('continent')" class="mt-2 text-center font-sans" />
                </div>

                <div>
                    <div class="relative w-full aspect-video bg-[#CFCFC4] border-2 border-transparent hover:border-brand-brown transition cursor-pointer group overflow-hidden">
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="document.getElementById('previewCreate').src = window.URL.createObjectURL(this.files[0]); document.getElementById('previewCreate').classList.remove('hidden'); document.getElementById('iconCreate').classList.add('hidden');">
                        
                        <div id="iconCreate" class="absolute inset-0 flex items-center justify-center text-brand-brown/50 group-hover:text-brand-brown transition">
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span class="font-orator font-bold">CLICK TO UPLOAD</span>
                            </div>
                        </div>
                        <img id="previewCreate" src="#" class="absolute inset-0 w-full h-full object-cover hidden">
                    </div>
                    <x-input-error :messages="$errors->get('image')" class="mt-2 text-center font-sans" />
                </div>

                <div>
                    <div class="flex flex-col md:flex-row justify-center gap-4 md:gap-6 items-center">
                        <input type="text" name="city" value="{{ old('city') }}" placeholder="insert the city" class="bg-brand-cream border-2 border-brand-brown px-6 py-2 text-3xl font-reenie text-center text-brand-brown placeholder-brand-brown/60 focus:outline-none w-full md:w-64 rounded-md">
                        <span class="text-4xl font-reenie text-brand-brown hidden md:block">-</span>
                        <input type="text" name="country" value="{{ old('country') }}" placeholder="insert the country" class="bg-brand-cream border-2 border-brand-brown px-6 py-2 text-3xl font-reenie text-center text-brand-brown placeholder-brand-brown/60 focus:outline-none w-full md:w-64 rounded-md">
                    </div>
                    <div class="flex justify-center gap-4 mt-2 text-center font-sans">
                        <x-input-error :messages="$errors->get('city')" />
                        <x-input-error :messages="$errors->get('country')" />
                    </div>
                </div>

                <div>
                    <textarea name="description" rows="3" placeholder="write the description..." class="w-full bg-brand-cream border-2 border-brand-brown px-6 py-4 text-3xl font-reenie text-center text-brand-brown placeholder-brand-brown/60 focus:outline-none rounded-md resize-none">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2 text-center font-sans" />
                </div>

                <div class="text-center pt-4">
                    <button type="submit" class="px-12 py-3 bg-brand-brown text-brand-cream font-orator font-bold text-lg uppercase tracking-widest hover:bg-opacity-90 transition shadow-lg rounded-full hover:scale-105 transform">
                        Publish Postcard
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>