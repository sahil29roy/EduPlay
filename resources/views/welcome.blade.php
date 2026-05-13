<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EduPlay - Interactive Learning</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; background-color: #0F172A; }
            .text-gradient {
                background: linear-gradient(135deg, #818CF8, #F472B6);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .premium-gradient {
                background: linear-gradient(135deg, #6366F1, #EC4899);
            }
            .glass {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .floating {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }
        </style>
    </head>
    <body class="antialiased text-white overflow-hidden">
        <div class="relative min-h-screen flex items-center justify-center">
            <!-- Background Elements -->
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-600/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-pink-600/20 rounded-full blur-[120px]"></div>
            
            <div class="relative z-10 max-w-5xl px-6 text-center">
                <div class="mb-8 inline-flex items-center space-x-2 glass px-6 py-2 rounded-full border-white/10">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-500"></span>
                    <span class="text-sm font-medium text-slate-300">Level Up Your Learning</span>
                </div>
                
                <h1 class="text-7xl md:text-8xl font-bold tracking-tight mb-8">
                    Play. Learn. <br>
                    <span class="text-gradient">Create.</span>
                </h1>
                
                <p class="text-xl text-slate-400 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Welcome to EduPlay, the ultimate interactive platform where educational mini-games meet gamified rewards. Improve your logic, math, and creativity while having fun!
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="premium-gradient text-white px-10 py-5 rounded-2xl font-bold text-lg shadow-2xl shadow-indigo-500/40 hover:scale-105 transition-all">
                            Enter Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="premium-gradient text-white px-10 py-5 rounded-2xl font-bold text-lg shadow-2xl shadow-indigo-500/40 hover:scale-105 transition-all">
                            Start Your Journey
                        </a>
                        <a href="{{ route('login') }}" class="glass text-white px-10 py-5 rounded-2xl font-bold text-lg hover:bg-white/5 transition-all">
                            Member Login
                        </a>
                    @endauth
                </div>
                
                <!-- Floating Icons -->
                <div class="absolute -top-20 -left-20 text-6xl floating" style="animation-delay: 0s">🧠</div>
                <div class="absolute top-40 -right-20 text-6xl floating" style="animation-delay: 2s">🔢</div>
                <div class="absolute -bottom-20 left-40 text-6xl floating" style="animation-delay: 4s">🧩</div>
            </div>
        </div>
        
        <!-- Feature Cards Mini Preview -->
        <div class="fixed bottom-12 left-0 w-full px-6 hidden md:block">
            <div class="max-w-5xl mx-auto grid grid-cols-3 gap-6">
                <div class="glass p-6 rounded-2xl border-white/5">
                    <h3 class="font-bold mb-2">Unlock Rewards</h3>
                    <p class="text-slate-500 text-sm">Earn points for every mission complete.</p>
                </div>
                <div class="glass p-6 rounded-2xl border-white/5">
                    <h3 class="font-bold mb-2">Daily Challenges</h3>
                    <p class="text-slate-500 text-sm">New educational puzzles every day.</p>
                </div>
                <div class="glass p-6 rounded-2xl border-white/5">
                    <h3 class="font-bold mb-2">Track Progress</h3>
                    <p class="text-slate-500 text-sm">See your level grow as you learn.</p>
                </div>
            </div>
        </div>
    </body>
</html>
