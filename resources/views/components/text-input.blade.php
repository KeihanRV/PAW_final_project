@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'w-full bg-brand-brown text-white border-0 rounded-lg p-3 placeholder-gray-400
                focus:outline-none focus:ring-2 focus:ring-brand-orange focus:ring-opacity-50'
]) !!}>