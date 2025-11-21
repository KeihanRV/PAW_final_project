@props(['href'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-sm uppercase tracking-widest hover:text-brand-second transition hover:translate-x-1 duration-300']) }}>
    {{ $slot }}
</a>