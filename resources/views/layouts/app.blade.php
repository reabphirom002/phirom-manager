<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'PHIROM MANAGER') }}</title>

        <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Instant Theme Engine (រត់មុនគេបង្អស់ដើម្បីកុំឱ្យយឺត) -->
        <script>
            (function() {
                const isDark = localStorage.getItem('darkMode') !== 'false'; // Default to true
                if (isDark) document.documentElement.classList.add('dark');
                else document.documentElement.classList.remove('dark');
            })();
        </script>

        <style>
            body { font-family: 'Kantumruy Pro', sans-serif; }
            [x-cloak] { display: none !important; }
            .dot-pattern {
                background-image: radial-gradient(rgba(99, 102, 241, 0.08) 1.5px, transparent 1.5px);
                background-size: 32px 32px;
            }
            .dark .dot-pattern {
                background-image: radial-gradient(rgba(99, 102, 241, 0.12) 1.5px, transparent 1.5px);
            }
        </style>
    </head>
    <!-- បន្ថយ duration មកត្រឹម 150ms ដើម្បីឱ្យការដូរពណ៌លឿនដូចផ្លេកបន្ទោរ -->
    <body x-data="{ darkMode: localStorage.getItem('darkMode') !== 'false' }" 
          :class="darkMode ? 'bg-slate-950 text-slate-100 dark' : 'bg-slate-50/60 text-slate-800'"
          class="antialiased min-h-screen transition-colors duration-150 relative dot-pattern">

        <!-- Ambient Background -->
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-500/10 dark:bg-blue-600/15 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-500/10 dark:bg-purple-600/15 rounded-full blur-[100px]"></div>
        </div>

        <div class="min-h-screen flex flex-col justify-between">
            <div>
                @include('layouts.navigation')
                <main>{{ $slot }}</main>
            </div>

            <footer :class="darkMode ? 'bg-slate-950/80 border-slate-900 text-slate-500' : 'bg-white/80 border-slate-200 text-gray-400'"
                    class="border-t py-12 px-4 text-center space-y-2 transition-colors duration-150 backdrop-blur-sm">
                <p class="text-xs sm:text-sm font-black tracking-[0.2em] uppercase">
                    {{ __('messages.copyright') }}
                </p>
                <p class="text-[10px] font-bold opacity-40 uppercase tracking-widest italic">
                    Premium Enterprise Management System
                </p>
            </footer>
        </div>
    </body>
</html>