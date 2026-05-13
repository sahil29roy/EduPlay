<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="w-10 h-10 glass-card flex items-center justify-center text-white hover:text-indigo-400 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="font-semibold text-2xl text-white leading-tight">
                    {{ $game->icon }} {{ $game->name }}
                </h2>
            </div>
            <div id="game-stats" class="flex space-x-4">
                <div class="glass-card px-4 py-2 border-indigo-500/30">
                    <span class="text-slate-400 text-sm">Score:</span>
                    <span id="current-score" class="text-white font-bold ml-2">0</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card p-1 overflow-hidden">
                <div id="game-container" class="bg-slate-900 rounded-[1.4rem] min-h-[500px] relative flex flex-col items-center justify-center p-8">
                    
                    <!-- Start Screen -->
                    <div id="start-screen" class="text-center z-20">
                        <div class="text-8xl mb-8 animate-bounce">{{ $game->icon }}</div>
                        <h3 class="text-4xl font-bold text-white mb-4">Ready for {{ $game->name }}?</h3>
                        <p class="text-slate-400 text-lg mb-10 max-w-md mx-auto">{{ $game->description }}</p>
                        <button onclick="startGame()" class="premium-gradient text-white text-xl px-12 py-4 rounded-2xl font-bold shadow-2xl shadow-indigo-500/40 hover:scale-105 transition-all">
                            Start Mission
                        </button>
                    </div>

                    <!-- Game Area (Dynamic) -->
                    <div id="game-area" class="hidden w-full h-full flex flex-col items-center justify-center">
                        <!-- Content injected by JS -->
                    </div>

                    <!-- Result Screen -->
                    <div id="result-screen" class="hidden text-center z-20">
                        <div class="text-6xl mb-6">🎉</div>
                        <h3 class="text-4xl font-bold text-white mb-2">Mission Complete!</h3>
                        <p class="text-slate-400 text-xl mb-8">You earned <span id="final-score" class="text-indigo-400 font-bold">0</span> points</p>
                        <div class="flex space-x-4 justify-center">
                            <button onclick="location.reload()" class="bg-white/10 text-white px-8 py-3 rounded-xl font-bold hover:bg-white/20 transition-all">
                                Try Again
                            </button>
                            <a href="{{ route('dashboard') }}" class="premium-gradient text-white px-8 py-3 rounded-xl font-bold shadow-lg">
                                Back to Dashboard
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const gameSlug = "{{ $game->slug }}";
        const pointsReward = {{ $game->points_reward }};
        let score = 0;
        let gameActive = false;

        function startGame() {
            document.getElementById('start-screen').classList.add('hidden');
            document.getElementById('game-area').classList.remove('hidden');
            gameActive = true;
            
            if (gameSlug === 'memory-matrix') initMemoryGame();
            else if (gameSlug === 'math-quest') initMathGame();
            else if (gameSlug === 'logic-link') initLogicGame();
        }

        function finishGame(finalScore) {
            gameActive = false;
            document.getElementById('game-area').classList.add('hidden');
            document.getElementById('result-screen').classList.remove('hidden');
            document.getElementById('final-score').innerText = finalScore;
            
            // Save Progress via AJAX
            fetch("{{ route('games.save', $game->slug) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ score: finalScore })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Progress saved:', data);
            });
        }

        /* --- MEMORY MATRIX GAME --- */
        function initMemoryGame() {
            const area = document.getElementById('game-area');
            area.innerHTML = '<div class="grid grid-cols-4 gap-4" id="memory-grid"></div>';
            const grid = document.getElementById('memory-grid');
            const icons = ['🍎', '🚀', '🎨', '🧩', '🎸', '🧪', '🌍', '📚'];
            const cards = [...icons, ...icons].sort(() => Math.random() - 0.5);
            let flipped = [];
            let matches = 0;

            cards.forEach((icon, index) => {
                const card = document.createElement('div');
                card.className = 'w-20 h-20 glass-card flex items-center justify-center text-3xl cursor-pointer hover:bg-white/10 transition-all duration-300';
                card.innerHTML = '?';
                card.onclick = () => {
                    if (flipped.length < 2 && !flipped.includes(card) && card.innerHTML === '?') {
                        card.innerHTML = icon;
                        card.classList.add('bg-indigo-500/20', 'border-indigo-500');
                        flipped.push({card, icon});
                        
                        if (flipped.length === 2) {
                            setTimeout(() => {
                                if (flipped[0].icon === flipped[1].icon) {
                                    matches++;
                                    score += 10;
                                    document.getElementById('current-score').innerText = score;
                                    if (matches === icons.length) finishGame(score);
                                } else {
                                    flipped[0].card.innerHTML = '?';
                                    flipped[1].card.innerHTML = '?';
                                    flipped[0].card.classList.remove('bg-indigo-500/20', 'border-indigo-500');
                                    flipped[1].card.classList.remove('bg-indigo-500/20', 'border-indigo-500');
                                }
                                flipped = [];
                            }, 600);
                        }
                    }
                };
                grid.appendChild(card);
            });
        }

        /* --- MATH QUEST GAME --- */
        function initMathGame() {
            const area = document.getElementById('game-area');
            let timeLeft = 30;
            let currentProblem = {};
            
            area.innerHTML = `
                <div class="text-center">
                    <div class="text-2xl text-pink-400 mb-4 font-bold">Time: <span id="timer">30</span>s</div>
                    <div id="problem" class="text-6xl font-bold text-white mb-8 tracking-tighter"></div>
                    <input type="number" id="math-answer" class="bg-white/5 border-2 border-white/10 rounded-2xl p-6 text-4xl text-white text-center w-48 focus:border-pink-500 outline-none transition-all" autofocus>
                </div>
            `;

            const input = document.getElementById('math-answer');
            const timerDisplay = document.getElementById('timer');
            
            const generateProblem = () => {
                const a = Math.floor(Math.random() * 12) + 1;
                const b = Math.floor(Math.random() * 12) + 1;
                const op = Math.random() > 0.5 ? '+' : 'x';
                currentProblem = { a, b, op, ans: op === '+' ? a+b : a*b };
                document.getElementById('problem').innerText = `${a} ${op} ${b} = ?`;
                input.value = '';
            };

            const timer = setInterval(() => {
                timeLeft--;
                timerDisplay.innerText = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    finishGame(score);
                }
            }, 1000);

            input.oninput = () => {
                if (parseInt(input.value) === currentProblem.ans) {
                    score += 5;
                    document.getElementById('current-score').innerText = score;
                    generateProblem();
                }
            };

            generateProblem();
        }

        /* --- LOGIC LINK GAME --- */
        function initLogicGame() {
            const area = document.getElementById('game-area');
            area.innerHTML = `
                <div class="text-center">
                    <p class="text-slate-400 mb-8">Select the odd one out!</p>
                    <div id="logic-grid" class="grid grid-cols-3 gap-6"></div>
                </div>
            `;
            const grid = document.getElementById('logic-grid');
            
            const levels = [
                { items: ['🍎', '🍌', '🍇', '🚗'], odd: '🚗' },
                { items: ['🐶', '🐱', '🐹', '🍕'], odd: '🍕' },
                { items: ['🎸', '🎻', '🎺', '🚲'], odd: '🚲' },
                { items: ['🌑', '🌕', '🌗', '🏠'], odd: '🏠' },
                { items: ['⚽', '🏀', '🎾', '💻'], odd: '💻' }
            ];
            
            let currentLevel = 0;

            const loadLevel = () => {
                grid.innerHTML = '';
                const level = levels[currentLevel];
                level.items.sort(() => Math.random() - 0.5).forEach(item => {
                    const btn = document.createElement('div');
                    btn.className = 'w-24 h-24 glass-card flex items-center justify-center text-4xl cursor-pointer hover:scale-110 transition-transform';
                    btn.innerHTML = item;
                    btn.onclick = () => {
                        if (item === level.odd) {
                            score += 20;
                            document.getElementById('current-score').innerText = score;
                            currentLevel++;
                            if (currentLevel < levels.length) loadLevel();
                            else finishGame(score);
                        } else {
                            btn.classList.add('border-red-500', 'bg-red-500/10');
                            setTimeout(() => btn.classList.remove('border-red-500', 'bg-red-500/10'), 500);
                        }
                    };
                    grid.appendChild(btn);
                });
            };

            loadLevel();
        }
    </script>
</x-app-layout>
