<x-app-layout title="Admin Dashboard">
    
    <div x-data="{ createOpen: false, editOpen: null }" class="min-h-screen bg-brand-cream pb-24 relative">
        
        <div class="pt-12 pb-8 text-center mx-6">
            <h2 class="text-xl font-orator font-bold text-brand-brown uppercase tracking-widest mb-2">
                Welcome Aboard,
            </h2>
            <h1 class="text-2xl md:text-2xl font-orator font-bold text-brand-brown uppercase tracking-widest">
                {{ Auth::user()->name }}
            </h1>
        </div>

        <div class="max-w-5xl mx-auto px-4 mb-16">
            <div class="border-2 border-brand-brown p-6 md:p-10 flex flex-col md:flex-row gap-8 items-center justify-between">
                
                <div class="flex flex-col items-center justify-center md:w-1/3">
                    <div class="flex gap-1 select-none mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="ARCH" class="h-15 w-auto">
                    </div>
                    <span class="font-orator text-2xl font-bold text-brand-brown tracking-[0.3em] uppercase">So Far</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full md:w-2/3">
                    <div class="bg-brand-brown p-6 rounded-lg text-brand-cream font-orator md:row-span-2 flex flex-col justify-center">
                        <h3 class="text-center text-xl mb-4 border-b border-brand-cream/20 pb-2 uppercase tracking-widest">Postcard</h3>
                        <div class="space-y-3 text-sm uppercase tracking-widest">
                            <div class="flex justify-between"><span>Europe</span> <span>: {{ $stats['europe'] }}</span></div>
                            <div class="flex justify-between"><span>America</span> <span>: {{ $stats['america'] }}</span></div>
                            <div class="flex justify-between"><span>Asia</span> <span>: {{ $stats['asia'] }}</span></div>
                            <div class="flex justify-between"><span>Africa</span> <span>: {{ $stats['africa'] }}</span></div>
                        </div>
                    </div>
                    <div class="bg-brand-brown p-6 rounded-lg text-brand-cream font-orator flex flex-col justify-center">
                        <h3 class="text-center text-xl mb-2 border-b border-brand-cream/20 pb-2 uppercase tracking-widest">Data</h3>
                        <div class="space-y-2 text-sm uppercase tracking-widest">
                            <div class="flex justify-between"><span>User</span> <span>: {{ $stats['users'] }}</span></div>
                            <div class="flex justify-between"><span>Admin</span> <span>: {{ $stats['admins'] }}</span></div>
                        </div>
                    </div>
                    <div class="bg-brand-brown p-6 rounded-lg text-brand-cream font-orator flex flex-col justify-center">
                        <h3 class="text-center text-xl mb-2 border-b border-brand-cream/20 pb-2 uppercase tracking-widest">Journal</h3>
                        <div class="text-sm uppercase tracking-widest">
                            <div class="flex justify-between"><span>Made</span> <span>: {{ $stats['total'] }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h3 class="text-5xl font-reenie text-brand-brown text-center mb-12 underline decoration-brand-brown/50 underline-offset-8">
                Manage Collection
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($postcards as $postcard)
                    <div class="relative group">
                        <div class="bg-white p-3 shadow-md border border-brand-brown/10 rotate-0 transition duration-300 w-full">
                            <div class="aspect-[16/9] bg-gray-200 w-full overflow-hidden relative">
                                <img src="{{ asset($postcard->image) }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-brand-brown/80 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center gap-4">
                                    <button @click="editOpen = {{ $postcard->id }}" class="px-4 py-2 bg-brand-cream text-brand-brown font-orator font-bold rounded hover:bg-white transition">EDIT</button>
                                    <form action="{{ route('admin.postcard.destroy', $postcard) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white font-orator font-bold rounded hover:bg-red-700 transition">DELETE</button>
                                    </form>
                                </div>
                            </div>
                            <p class="mt-4 text-3xl font-reenie text-brand-brown text-center">{{ $postcard->city }} - {{ $postcard->country }}</p>
                        </div>

                        <div x-show="editOpen === {{ $postcard->id }}" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-brand-brown/90 backdrop-blur-sm p-4 overflow-y-auto">
                            <div @click="editOpen = null" class="absolute inset-0"></div>
                            <div class="bg-brand-cream border-2 border-brand-brown p-8 w-full max-w-3xl relative shadow-2xl rounded-lg">
                                <h2 class="text-3xl font-orator font-bold text-brand-brown mb-6 text-center">Edit Postcard</h2>
                                <form action="{{ route('admin.postcard.update', $postcard) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                    @csrf @method('PUT')
                                    <div class="text-center">
                                        <select name="continent" class="bg-brand-cream border-2 border-brand-brown px-4 py-2 text-2xl font-reenie text-brand-brown w-full text-center">
                                            <option value="Classic of Europe" {{ $postcard->continent == 'Classic of Europe' ? 'selected' : '' }}>Classic of Europe</option>
                                            <option value="Classic of Asia" {{ $postcard->continent == 'Classic of Asia' ? 'selected' : '' }}>Classic of Asia</option>
                                            <option value="Classic of Africa" {{ $postcard->continent == 'Classic of Africa' ? 'selected' : '' }}>Classic of Africa</option>
                                            <option value="Classic of America" {{ $postcard->continent == 'Classic of America' ? 'selected' : '' }}>Classic of America</option>
                                        </select>
                                    </div>
                                    <div class="flex gap-4">
                                        <input type="text" name="city" value="{{ $postcard->city }}" class="w-1/2 bg-brand-cream border-2 border-brand-brown px-4 py-2 text-2xl font-reenie text-center text-brand-brown">
                                        <input type="text" name="country" value="{{ $postcard->country }}" class="w-1/2 bg-brand-cream border-2 border-brand-brown px-4 py-2 text-2xl font-reenie text-center text-brand-brown">
                                    </div>
                                    <textarea name="description" rows="3" class="w-full bg-brand-cream border-2 border-brand-brown px-4 py-2 text-2xl font-reenie text-center text-brand-brown">{{ $postcard->description }}</textarea>
                                    <div class="text-center"><p class="font-orator text-sm mb-2">Change Image (Optional)</p><input type="file" name="image" class="border border-brand-brown p-2 w-full"></div>
                                    <div class="flex justify-center gap-4 mt-4">
                                        <button type="button" @click="editOpen = null" class="px-6 py-2 border-2 border-brand-brown text-brand-brown font-orator font-bold uppercase hover:bg-brand-brown/10">Cancel</button>
                                        <button type="submit" class="px-6 py-2 bg-brand-brown text-brand-cream font-orator font-bold uppercase hover:opacity-90">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <x-admin.create-postcard-modal />

    </div>
</x-app-layout>