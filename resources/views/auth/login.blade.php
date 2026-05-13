<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
        <p class="text-slate-400">Enter your mission credentials</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label class="block font-medium text-sm text-slate-300 mb-1">Email</label>
            <input id="email" class="block w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-indigo-500 focus:ring-indigo-500 transition-all outline-none" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label class="block font-medium text-sm text-slate-300 mb-1">Password</label>
            <input id="password" class="block w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-indigo-500 focus:ring-indigo-500 transition-all outline-none" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-slate-400">{{ __('Remember me') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="w-full premium-gradient text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 hover:scale-[1.02] transition-all">
            Log In
        </button>
        
        <div class="text-center pt-4">
            <p class="text-slate-500 text-sm">
                New explorer? 
                <a href="{{ route('register') }}" class="text-pink-400 font-bold hover:text-pink-300 transition-colors">Create Account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
