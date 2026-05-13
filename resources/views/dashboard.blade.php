<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                Welcome back, <span class="text-gradient">{{ Auth::user()->name }}</span>!
            </h2>
            <div class="flex items-center space-x-6">
                <div class="glass-card px-4 py-2 flex items-center space-x-2 border-indigo-500/30">
                    <span class="text-indigo-400 font-bold text-lg">Level {{ Auth::user()->level }}</span>
                </div>
                <div class="glass-card px-4 py-2 flex items-center space-x-2 border-pink-500/30">
                    <span class="text-pink-400 font-bold text-lg">{{ Auth::user()->points }} Points</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Progress Bar -->
            <div class="mb-12 glass-card p-6 border-white/5 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg class="w-32 h-32 text-indigo-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider font-semibold">Your Progress</p>
                            <h3 class="text-3xl font-bold text-white">Next Level in {{ 100 - (Auth::user()->points % 100) }} points</h3>
                        </div>
                        <p class="text-slate-400 font-medium">{{ Auth::user()->points % 100 }}%</p>
                    </div>
                    <div class="w-full bg-slate-800 rounded-full h-4">
                        <div class="premium-gradient h-4 rounded-full shadow-[0_0_15px_rgba(99,102,241,0.5)] transition-all duration-1000 ease-out" style="width: {{ Auth::user()->points % 100 }}%"></div>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold text-white mb-8 flex items-center">
                <span class="w-8 h-1 premium-gradient rounded-full mr-3"></span>
                Pick Your Adventure
            </h3>

            <!-- Game Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($games as $game)
                <div class="glass-card p-8 group relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:scale-110 transition-transform duration-500">
                        <span class="text-9xl">{{ $game->icon }}</span>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="w-16 h-16 glass-card border-white/10 flex items-center justify-center text-4xl mb-6 shadow-xl">
                            {{ $game->icon }}
                        </div>
                        
                        <h4 class="text-2xl font-bold text-white mb-3">{{ $game->name }}</h4>
                        <p class="text-slate-400 mb-8 line-clamp-2 leading-relaxed">{{ $game->description }}</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-indigo-400 font-semibold">+{{ $game->points_reward }} pts</span>
                            <a href="{{ route('games.show', $game->slug) }}" class="premium-gradient text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 transition-all">
                                Play Now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Stats/Rewards Section -->
            <div class="mt-16 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="glass-card p-8 border-indigo-500/10">
                    <h4 class="text-xl font-bold text-white mb-6">Recent Achievements</h4>
                    <div class="space-y-4">
                        <div class="flex items-center p-4 rounded-2xl bg-white/5 border border-white/5">
                            <div class="w-12 h-12 rounded-full bg-yellow-500/20 flex items-center justify-center text-yellow-500 mr-4">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold">First Game Played</p>
                                <p class="text-slate-500 text-sm">Welcome to the adventure!</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 rounded-2xl bg-white/5 border border-white/5 opacity-50">
                            <div class="w-12 h-12 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-500 mr-4">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94.45 1.64 1.81 2.89 3.61 3.06v3H9v2h6v-2h-2v-3c1.8-.17 3.16-1.42 3.61-3.06C17.08 12.63 19 10.55 19 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z"/></svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold">Level 10 reached</p>
                                <p class="text-slate-500 text-sm">Locked - Keep playing!</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="glass-card p-8 border-pink-500/10">
                    <h4 class="text-xl font-bold text-white mb-6">Creativity Board</h4>
                    <div class="h-48 rounded-2xl bg-slate-800/50 flex flex-col items-center justify-center border-2 border-dashed border-white/10">
                        <p class="text-slate-500 mb-2">Coming Soon</p>
                        <p class="text-white text-center px-8">A place to share your creative puzzle solutions and logic patterns!</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
