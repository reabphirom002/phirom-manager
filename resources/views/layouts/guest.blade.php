<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PHIROM MANAGER') }}</title>

        <!-- Google Fonts: Kantumruy Pro -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Instant Theme Engine (រត់ភ្លាមៗដើម្បីល្បឿនលឿនបំផុត) -->
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
            
            /* Global Premium Background Dot Pattern */
            .dot-pattern {
                background-image: radial-gradient(rgba(99, 102, 241, 0.08) 1.5px, transparent 1.5px);
                background-size: 32px 32px;
            }
            .dark .dot-pattern {
                background-image: radial-gradient(rgba(99, 102, 241, 0.12) 1.5px, transparent 1.5px);
            }
        </style>
    </head>
    <body x-data="{ darkMode: localStorage.getItem('darkMode') !== 'false' }" 
          :class="darkMode ? 'bg-slate-950 text-slate-100 dark' : 'bg-slate-50/60 text-slate-800'"
          class="antialiased font-sans transition-colors duration-150 dot-pattern">
        
        <!-- Global Background Mesh Gradients (Fixed) -->
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-500/10 dark:bg-blue-600/15 rounded-full blur-[130px]"></div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-purple-500/10 dark:bg-purple-600/15 rounded-full blur-[100px]"></div>
        </div>

        <!-- Parent Split-Screen Container -->
        <div class="min-h-screen flex flex-col md:flex-row backdrop-blur-[2px]">
            
            <!-- ១. ចំហៀងខាងឆ្វេង៖ បង្ហាញរូបភាពក្រុមហ៊ុនធំ និងឡូហ្គោ (Desktop Only) -->
            <div class="hidden md:flex md:w-1/2 lg:w-3/5 bg-slate-900 relative items-center justify-center p-12 overflow-hidden border-r border-slate-800/50">
                <img src="https://images.unsplash.com/photo-1547082299-de196ea013d6?auto=format&fit=crop&w=1200&q=80" 
                     class="absolute inset-0 w-full h-full object-cover opacity-20 transform scale-105" 
                     alt="PHIROM COMPANY Setup">
                
                <div class="absolute inset-0 bg-gradient-to-tr from-slate-950 via-slate-950/50 to-transparent"></div>

                <div class="relative z-10 max-w-lg space-y-8 text-left">
                    <div class="flex items-center space-x-5 group">
                        <div class="relative">
                            <div class="absolute -inset-1 bg-blue-500 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-300"></div>
                            <img class="relative h-16 w-16 rounded-full object-cover border-2 border-indigo-500 shadow-xl" src="{{ asset('images/logo.png') }}" alt="Logo">
                        </div>
                        <span class="text-3xl font-black tracking-widest bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent uppercase">
                            PHIROM MANAGER
                        </span>
                    </div>
                    
                    <div class="space-y-4">
                        <h1 class="text-4xl font-black text-white leading-tight">
                            {{ app()->getLocale() == 'km' ? 'គ្រប់គ្រងអាជីវកម្មរបស់អ្នកប្រកបដោយទំនុកចិត្ត និងប្រសិទ្ធភាពខ្ពស់' : 'Manage your business with confidence and high efficiency' }}
                        </h1>
                        <p class="text-slate-400 text-sm leading-relaxed font-medium">
                            {{ app()->getLocale() == 'km' ? 'ប្រព័ន្ធគ្រប់គ្រងសហគ្រាសរួមបញ្ចូលគ្នា (ERP) ភិរម្យ ជួយសម្រួលដល់ការចាត់ចែងការងារទូទាំងក្រុមហ៊ុន ហាងកុំព្យូទ័រ សាលារៀន និងហាងកាហ្វេ ឱ្យដំណើរការទៅដោយស្វ័យប្រវត្ត និងរលូនបំផុត។' : 'PHIROM Enterprise Resource Planning (ERP) streamlines operations across your company, computer shop, school, and cafe smoothly and automatically.' }}
                        </p>
                    </div>

                    <div class="pt-6 border-t border-slate-800/80 text-[11px] text-slate-500 flex items-center space-x-6 font-bold uppercase tracking-widest">
                        <span>🛡️ {{ app()->getLocale() == 'km' ? 'Enterprise Security' : 'Enterprise Security' }}</span>
                        <span>☕ {{ app()->getLocale() == 'km' ? 'Managed Workspaces' : 'Managed Workspaces' }}</span>
                    </div>
                </div>
            </div>

            <!-- ២. ចំហៀងខាងស្ដាំ៖ ប្រអប់បញ្ចូលទិន្នន័យ (Forms) -->
            <div class="w-full md:w-1/2 lg:w-2/5 flex flex-col justify-between items-center px-6 py-12 transition-all duration-150 relative">
                
                <!-- ប៊ូតុងត្រឡប់ទៅទំព័រដើម Welcome -->
                <div class="absolute top-8 left-8">
                    <a href="/" class="text-xs font-black text-slate-500 hover:text-indigo-500 dark:hover:text-indigo-400 transition-all duration-150 flex items-center group">
                        <span class="mr-2 group-hover:-translate-x-1 transition-transform">&larr;</span> 
                        {{ app()->getLocale() == 'km' ? 'ត្រឡប់ទៅទំព័រដើម' : 'Back to Home' }}
                    </a>
                </div>

                <!-- ប្រអប់ទម្រង់បែបបទ Form (Login/Register Forms are injected here) -->
                <div class="w-full max-w-sm mt-16 space-y-6 my-auto">
                    {{ $slot }}
                </div>

                <!-- របារកូពីរ៉ាយរក្សាសិទ្ធិនៅបាតក្រោមអូតូ -->
                <div class="text-center pt-8 border-t border-slate-200 dark:border-slate-800/50 w-full">
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 font-black uppercase tracking-widest">
                        {{ __('messages.copyright') }}
                    </p>
                </div>
            </div>

        </div>
    </body>
</html>