<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-3 premium-gradient border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/20']) }}>
    {{ $slot }}
</button>
