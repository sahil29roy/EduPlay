<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduPlay') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --primary: #6366F1;
                --secondary: #EC4899;
                --accent: #10B981;
                --bg-dark: #0F172A;
                --bg-card: rgba(30, 41, 59, 0.7);
                --glass: rgba(255, 255, 255, 0.05);
                --glass-border: rgba(255, 255, 255, 0.1);
            }

            body {
                font-family: 'Outfit', sans-serif;
                background-color: var(--bg-dark);
                color: #F8FAFC;
            }

            .glass-card {
                background: var(--bg-card);
                backdrop-filter: blur(12px);
                border: 1px solid var(--glass-border);
                border-radius: 1.5rem;
                transition: all 0.3s ease;
            }

            .glass-card:hover {
                border-color: var(--primary);
                transform: translateY(-5px);
                box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.3);
            }

            .premium-gradient {
                background: linear-gradient(135deg, var(--primary), var(--secondary));
            }

            .text-gradient {
                background: linear-gradient(135deg, #818CF8, #F472B6);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-track {
                background: var(--bg-dark);
            }
            ::-webkit-scrollbar-thumb {
                background: #334155;
                border-radius: 10px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #475569;
            }
        </style>
    </head>
    <body class="font-sans antialiased selection:bg-indigo-500 selection:text-white">
        <div class="min-h-screen bg-[#0F172A] bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-900/20 via-slate-900 to-slate-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="border-b border-white/5 bg-slate-900/50 backdrop-blur-md sticky top-0 z-40">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
