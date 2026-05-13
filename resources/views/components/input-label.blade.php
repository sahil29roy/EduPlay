@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-slate-400 mb-2 uppercase tracking-wider']) }}>
    {{ $value ?? $slot }}
</label>
