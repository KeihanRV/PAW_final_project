<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center px-10 py-3 bg-brand-brown text-brand-cream font-orator font-semibold rounded-lg shadow-md 
                        border border-brand-brown  
               hover:bg-brand-card-bg hover:text-brand-brown transition duration-300 text-center'
]) }}>
    {{ $slot }}
</button>