<section>
    <form method="post" action="{{ route('profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
        @csrf
        @method('patch')

        <div class="space-y-6">
            
            <div>
                <label for="name" class="block font-bold text-brand-brown mb-2 font-orator tracking-wider">FULL NAME</label>
                <input id="name" name="name" type="text" class="w-full bg-[#EBE2D1] border-[3px] border-brand-brown px-4 py-3 font-bold text-brand-brown focus:outline-none focus:border-brand-brown/80 rounded-sm" value="{{ old('name', $user->name) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="email" class="block font-bold text-brand-brown mb-2 font-orator tracking-wider">EMAIL</label>
                <input id="email" name="email" type="email" class="w-full bg-[#EBE2D1] border-[3px] border-brand-brown px-4 py-3 font-bold text-brand-brown focus:outline-none focus:border-brand-brown/80 rounded-sm" value="{{ old('email', $user->email) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <label for="birthdate" class="block font-bold text-brand-brown mb-2 font-orator tracking-wider">BIRTHDATE</label>
                <input id="birthdate" name="birthdate" type="date" class="w-full bg-[#EBE2D1] border-[3px] border-brand-brown px-4 py-3 font-bold text-brand-brown focus:outline-none focus:border-brand-brown/80 rounded-sm" value="{{ old('birthdate', optional($user->birthdate)->format('Y-m-d')) }}" />
                <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
            </div>

            <div class="pt-4">
                <button type="submit" class="px-8 py-3 bg-brand-brown text-brand-cream font-bold font-orator rounded-sm hover:bg-brand-brown/90 transition uppercase tracking-widest shadow-md hover:shadow-none hover:translate-y-[1px]">
                    SAVE
                </button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-brand-brown mt-2 font-bold">{{ __('Saved.') }}</p>
                @endif
            </div>
        </div>


        <div class="space-y-6">
            
            <div>
                <label class="block font-bold text-brand-brown mb-2 font-orator tracking-wider">ROLE</label>
                <input type="text" class="w-full bg-[#EBE2D1] border-[3px] border-brand-brown px-4 py-3 font-bold text-brand-brown focus:outline-none rounded-sm opacity-70 cursor-not-allowed" value="{{ strtoupper($user->role ?? 'User') }}" readonly disabled />
            </div>

            <div>
                <label for="phone" class="block font-bold text-brand-brown mb-2 font-orator tracking-wider">PHONE NUMBER</label>
                <input id="phone" name="phone" type="text" class="w-full bg-[#EBE2D1] border-[3px] border-brand-brown px-4 py-3 font-bold text-brand-brown focus:outline-none focus:border-brand-brown/80 rounded-sm" value="{{ old('phone', $user->phone) }}" placeholder="+62..." />
            </div>

             <div>
                <label for="birthplace" class="block font-bold text-brand-brown mb-2 font-orator tracking-wider">BIRTHPLACE</label>
                <input id="birthplace" name="birthplace" type="text" class="w-full bg-[#EBE2D1] border-[3px] border-brand-brown px-4 py-3 font-bold text-brand-brown focus:outline-none focus:border-brand-brown/80 rounded-sm" value="{{ old('birthplace', $user->birthplace) }}" />
            </div>


            <div class="pt-4 flex flex-wrap gap-4 items-center">
                
                <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'update-password-modal')" class="px-6 py-3 bg-brand-brown text-brand-cream font-bold font-orator rounded-sm hover:bg-brand-brown/90 transition uppercase tracking-widest">
                    Reset Password
                </button>

                <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="px-6 py-3 bg-brand-red text-brand-second font-bold font-orator rounded-sm hover:bg-red-700 transition uppercase tracking-widest shadow-md">
                    Delete Account
                </button>
            </div>
        </div>
    </form>


    <x-modal name="update-password-modal" focusable>
        <div class="p-6 bg-brand-cream text-brand-brown border-4 border-brand-brown">
            <h2 class="text-2xl font-orator font-bold text-brand-brown mb-4 uppercase tracking-widest">
                {{ __('Update Password') }}
            </h2>
            @include('profile.partials.update-password-form')
        </div>
    </x-modal>


    <x-caution-modal name="confirm-user-deletion">
        
        Deleting your account means all of your data in ARCH shall perish from existence.<br>
        Once occur, there is no turning back.

        <x-slot name="footer">
            <button x-on:click="$dispatch('close-modal', 'confirm-user-deletion'); $dispatch('open-modal', 'final-delete-confirm')" type="button" class="px-8 py-2 border-2 border-brand-brown text-brand-brown font-bold font-orator rounded-sm hover:bg-brand-brown hover:text-brand-cream transition uppercase tracking-widest">
                Yes
            </button>
            <button x-on:click="$dispatch('close-modal', 'confirm-user-deletion')" type="button" class="px-8 py-2 bg-[#D92525] text-white font-bold font-orator rounded-sm hover:bg-red-700 transition uppercase tracking-widest mr-4 shadow-lg">
                No
            </button>

        </x-slot>
    </x-caution-modal>


    <x-modal name="final-delete-confirm" focusable>
         <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-brand-cream text-brand-brown border-4 border-brand-brown">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-orator font-bold text-brand-brown uppercase tracking-widest mb-4">
                {{ __('Final Confirmation') }}
            </h2>

            <p class="mt-1 text-brand-brown text-lg">
                {{ __('Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <input id="password" name="password" type="password" class="mt-1 block w-3/4 bg-[#EBE2D1] border-[3px] border-brand-brown px-4 py-2 font-bold text-brand-brown focus:outline-none" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close-modal', 'final-delete-confirm')" class="px-6 py-2 border-2 border-brand-brown text-brand-brown font-bold font-orator uppercase">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="px-6 py-2 bg-[#D92525] text-white font-bold font-orator uppercase shadow-lg hover:bg-red-700">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>

</section>