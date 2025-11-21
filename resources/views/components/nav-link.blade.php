@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center self-center border-b-2 border-brand-brown px-1 pb-1 text-base font-orator font-bold text-brand-brown uppercase tracking-widest focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center self-center border-b-2 border-transparent px-1 pb-1 text-base font-orator font-bold text-brand-brown uppercase tracking-widest hover:border-brand-brown hover:text-opacity-80 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>