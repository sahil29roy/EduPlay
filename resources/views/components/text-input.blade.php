@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white/5 border-white/10 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm placeholder:text-slate-500']) !!}>
