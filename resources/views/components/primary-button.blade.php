<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center px-8 py-2 bg-brand-orange hover:bg-brand-orange-hover
                border border-transparent rounded-lg font-medium text-sm text-brand-brown tracking-widest
                focus:outline-none focus:ring-2 focus:ring-brand-orange focus:ring-offset-2
                transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>