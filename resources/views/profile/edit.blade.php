<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Your Profile') }}
            </h2>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500/10 text-red-400 px-6 py-2 rounded-xl font-bold border border-red-500/20 hover:bg-red-500/20 transition-all flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span>{{ __('Log Out') }}</span>
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Stats Header -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="glass-card p-8 border-indigo-500/30 flex items-center justify-between overflow-hidden relative">
                    <div class="relative z-10">
                        <p class="text-slate-400 text-sm uppercase tracking-widest font-bold mb-1">Current Level</p>
                        <h3 class="text-4xl font-black text-white">Level {{ Auth::user()->level }}</h3>
                    </div>
                    <div class="text-6xl opacity-20 absolute -right-4 -bottom-4 rotate-12">🏆</div>
                </div>
                <div class="glass-card p-8 border-pink-500/30 flex items-center justify-between overflow-hidden relative">
                    <div class="relative z-10">
                        <p class="text-slate-400 text-sm uppercase tracking-widest font-bold mb-1">Total Points</p>
                        <h3 class="text-4xl font-black text-white">{{ Auth::user()->points }} <span class="text-xl font-normal text-slate-400">PTS</span></h3>
                    </div>
                    <div class="text-6xl opacity-20 absolute -right-4 -bottom-4 -rotate-12">💎</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Forms -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="glass-card p-8 border-white/5">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="glass-card p-8 border-white/5">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Right Column: Settings & Danger Zone -->
                <div class="space-y-8">
                    <div class="glass-card p-8 border-red-500/20 bg-red-500/5">
                        <div class="max-w-xl text-white">
                            <h3 class="text-xl font-bold text-red-400 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Danger Zone
                            </h3>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
