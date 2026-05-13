<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-2">Join the Adventure</h2>
        <p class="text-slate-400">Create your profile to start playing</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label class="block font-medium text-sm text-slate-300 mb-1">Explorer Name</label>
            <input id="name" class="block w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-indigo-500 focus:ring-indigo-500 transition-all outline-none" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label class="block font-medium text-sm text-slate-300 mb-1">Email</label>
            <input id="email" class="block w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-indigo-500 focus:ring-indigo-500 transition-all outline-none" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label class="block font-medium text-sm text-slate-300 mb-1">Create Password</label>
            <input id="password" class="block w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-indigo-500 focus:ring-indigo-500 transition-all outline-none" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block font-medium text-sm text-slate-300 mb-1">Confirm Password</label>
            <input id="password_confirmation" class="block w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-indigo-500 focus:ring-indigo-500 transition-all outline-none" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full premium-gradient text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 hover:scale-[1.02] transition-all">
            Begin Journey
        </button>
        
        <div class="text-center pt-4">
            <p class="text-slate-500 text-sm">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-pink-400 font-bold hover:text-pink-300 transition-colors">Log In</a>
            </p>
        </div>
    </form>
</x-guest-layout>
