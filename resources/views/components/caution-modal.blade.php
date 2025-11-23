@props(['name', 'show' => false, 'title' => 'CAUTIONS!'])

<div x-data="{ show: @js($show) }"
     x-show="show"
     x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
     x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
     x-on:keydown.escape.window="show = false"
     style="display: none;"
     class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
>
    <div x-show="show"
         class="fixed inset-0 transform transition-all"
         x-on:click="show = false"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-brand-brown/60 backdrop-blur-sm"></div>
    </div>

    <div x-show="show"
         class="mb-6 bg-brand-cream border-[3px] border-brand-brown rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-md sm:mx-auto p-8 text-center"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        <h2 class="text-3xl font-orator font-bold text-brand-brown uppercase tracking-widest underline decoration-2 underline-offset-8 mb-6">
            {{ $title }}
        </h2>

        <div class="text-lg font-sans font-medium text-brand-brown leading-relaxed mb-6">
            {{ $slot }}
        </div>

        <div class="font-bold text-brand-brown text-xl mb-6">
            Will you wish to commit?
        </div>

        <div class="flex justify-center gap-4">
            {{ $footer }}
        </div>
    </div>
</div>