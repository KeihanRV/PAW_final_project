<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 border-l-2 border-brand-brown text-center font-orator text-sm font-bold text-brand-brown uppercase tracking-widest hover:bg-brand-brown hover:text-brand-cream focus:outline-none focus:bg-brand-brown focus:text-brand-cream transition duration-150 ease-in-out rounded-lg']) }}>
    {{ $slot }}
</a>