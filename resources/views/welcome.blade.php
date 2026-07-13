<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHIROM MANAGER - ប្រព័ន្ធគ្រប់គ្រងក្រុមហ៊ុន</title>
    
    <!-- ប្រើប្រាស់ Tailwind CSS តាមរយៈ Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- ហ្វុនអក្សរខ្មែរ Kantumruy Pro -->
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Kantumruy Pro', sans-serif;
        }
        [x-cloak] { display: none !important; }
        
        /* បន្ថែមទម្រង់ Grid Dot ស្អាតប្រណិតលើផ្ទៃខាងក្រោយ */
        .dot-pattern {
            background-image: radial-gradient(rgba(99, 102, 241, 0.08) 1.5px, transparent 1.5px);
            background-size: 24px 24px;
        }
        .dark .dot-pattern {
            background-image: radial-gradient(rgba(99, 102, 241, 0.15) 1.5px, transparent 1.5px);
            background-size: 24px 24px;
        }
    </style>

    <!-- ការពារកុំឲ្យជះពន្លឺពណ៌សភ្លឺភ្នែក (Instant Theme Apply Script) -->
    <script>
        if (localStorage.getItem('darkMode') !== 'false') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body x-data="{ darkMode: localStorage.getItem('darkMode') !== 'false' }" 
      :class="darkMode ? 'bg-slate-950 text-slate-100 dark' : 'bg-slate-50/60 text-slate-800'"
      class="antialiased min-h-screen flex flex-col justify-between transition-colors duration-300 dot-pattern">

    <!-- ១. របារម៉ឺនុយខាងលើ (Header Navigation) -->
    <header :class="darkMode ? 'bg-slate-950/80 border-slate-900 text-white shadow-lg shadow-slate-950/20' : 'bg-white/80 border-slate-100 text-slate-800 shadow-sm shadow-slate-100/50'"
            class="backdrop-blur-md border-b sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Logo និងឈ្មោះក្រុមហ៊ុន (បង្កើនគម្លាត Spacing និងអក្សរទូលាយមិនកិបគ្នា) -->
            <div class="flex items-center space-x-5">
                <div class="relative">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full blur opacity-40"></div>
                    <img class="relative h-11 w-11 rounded-full object-cover border-2 border-white dark:border-slate-900 shadow-md" src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <span class="text-2xl font-extrabold tracking-widest bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 bg-clip-text text-transparent">
                    PHIROM MANAGER
                </span>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- ប៊ូតុងកុងតាក់ប្ដូរពន្លឺ (Premium Theme Switcher Button) -->
                <button @click="
                            darkMode = !darkMode; 
                            localStorage.setItem('darkMode', darkMode);
                            if (darkMode) {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        " 
                        :class="darkMode ? 'bg-slate-900/80 border-slate-800 text-amber-400 hover:text-amber-300 hover:bg-slate-800/80' : 'bg-slate-100/80 border-slate-200/80 text-slate-500 hover:text-indigo-600 hover:bg-slate-200/50'"
                        class="p-2.5 rounded-xl border transition-all duration-300 focus:outline-none shadow-sm flex items-center justify-center"
                        title="ប្ដូរពន្លឺ">
                    <!-- Sun Icon (បង្ហាញពេល Dark Mode) -->
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path>
                    </svg>

                    <!-- Moon Icon (បង្ហាញពេល Light Mode) -->
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>

                <!-- ប៊ូតុងប្ដូរភាសាស្ទីលគ្រាប់ថ្នាំ (ខ្មែរ / EN) -->
                <div :class="darkMode ? 'bg-slate-900/50 border-slate-800' : 'bg-slate-100/80 border-slate-200/80'"
                     class="flex p-1 rounded-xl border backdrop-blur-sm">
                    <a href="{{ route('lang.switch', 'km') }}" 
                       class="px-3.5 py-1.5 text-xs font-bold rounded-lg transition-all duration-250 {{ app()->getLocale() == 'km' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-sm shadow-blue-500/20' : 'text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300' }}">
                        ខ្មែរ
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}" 
                       class="px-3.5 py-1.5 text-xs font-bold rounded-lg transition-all duration-250 {{ app()->getLocale() == 'en' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-sm shadow-blue-500/20' : 'text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300' }}">
                        EN
                    </a>
                </div>

                <!-- ប៊ូតុង Login / Register -->
                <div class="flex items-center space-x-2.5">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5.5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-xl shadow-lg shadow-blue-500/10 hover:shadow-blue-500/25 hover:opacity-95 transition-all duration-200">
                                {{ __('messages.go_to_dashboard') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               :class="darkMode ? 'text-slate-300 hover:text-white hover:bg-slate-900/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/50'" 
                               class="text-sm font-bold transition-all duration-200 px-4 py-2.5 rounded-xl">
                                {{ __('messages.login') }}
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5.5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-md hover:from-blue-700 hover:to-indigo-700 transition duration-150">
                                    {{ __('messages.register') }}
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- ២. ផ្នែកខាងលើបង្អស់ (Hero Section) -->
    <main class="flex-grow">
        <section class="relative py-24 sm:py-36 overflow-hidden">
            <!-- ពន្លឺ Mesh Gradient កម្រិតខ្ពស់ ប្រែប្រួលទៅតាម Dark/Light Mode -->
            <div :class="darkMode ? 'bg-blue-600/15' : 'bg-blue-500/5'" class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full blur-[130px] -z-10 transition duration-300"></div>
            <div :class="darkMode ? 'bg-purple-600/15' : 'bg-purple-500/5'" class="absolute top-1/3 left-1/3 w-[450px] h-[450px] rounded-full blur-[120px] -z-10 transition duration-300"></div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8 relative">
                <!-- Badge dynamic decoration -->
                <div class="inline-flex items-center space-x-2">
                    <span :class="darkMode ? 'bg-blue-500/10 text-blue-400 border-blue-500/20' : 'bg-blue-50 text-blue-600 border-blue-100'"
                          class="px-4 py-2 text-xs font-extrabold uppercase tracking-widest rounded-full border shadow-sm">
                        Enterprise Edition
                    </span>
                    <span :class="darkMode ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-emerald-50 text-emerald-600 border-emerald-100'"
                          class="px-3 py-2 text-xs font-extrabold uppercase tracking-widest rounded-full border shadow-sm">
                        v2.0
                    </span>
                </div>
                
                <!-- កែសម្រួល tracking មកជា normal ដើម្បីកុំឲ្យជើងអក្សរខ្មែររត់ជាន់គ្នា -->
                <h1 :class="darkMode ? 'from-white via-slate-100 to-slate-400' : 'from-slate-900 via-slate-800 to-slate-500'"
                    class="text-4xl sm:text-7xl font-extrabold tracking-normal leading-tight bg-gradient-to-b bg-clip-text text-transparent transition duration-300 max-w-4xl mx-auto">
                    {{ __('messages.welcome_title') }}
                </h1>
                
                <p :class="darkMode ? 'text-slate-400' : 'text-slate-500'" 
                   class="text-lg sm:text-xl max-w-3xl mx-auto leading-relaxed transition duration-300 font-medium">
                    {{ __('messages.welcome_subtitle') }}
                </p>
                
                <div class="pt-6">
                    <a href="{{ route('login') }}" class="relative group px-8 py-4.5 text-base font-extrabold text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:opacity-95 rounded-2xl shadow-xl shadow-blue-500/20 hover:shadow-blue-500/35 transition-all duration-200 inline-flex items-center">
                        <span>{{ __('messages.learn_more') }}</span>
                        <svg class="w-5 h-5 ms-2.5 group-hover:translate-x-1 transition duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- ៣. ផ្នែកបង្ហាញកាតសេវាកម្មទាំង ៤ (Interactive Cards) -->
        <section id="businesses" class="py-20 px-4 max-w-7xl mx-auto space-y-16">
            <div class="text-center space-y-4">
                <h2 :class="darkMode ? 'text-white' : 'text-slate-900'" class="text-3xl font-extrabold sm:text-4xl transition duration-300 tracking-wide">{{ __('messages.our_services') }}</h2>
                <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-indigo-500 mx-auto rounded-full"></div>
                <p :class="darkMode ? 'text-slate-400' : 'text-slate-500'" class="max-w-2xl mx-auto text-sm sm:text-base font-semibold transition duration-300">{{ __('messages.our_services_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- ១. ហាងលក់កុំព្យូទ័រ (Computer Workspace) -->
                <div :class="darkMode ? 'bg-slate-900/40 border-slate-800 hover:border-blue-500/40 hover:bg-slate-900/80 shadow-md shadow-slate-950/10' : 'bg-white border-slate-100 hover:border-blue-500/40 hover:shadow-xl shadow-sm shadow-slate-100'"
                     class="group rounded-3xl p-8 border flex flex-col justify-between hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition duration-300"></div>
                    <div>
                        <div class="w-12 h-12 bg-blue-500/10 text-blue-500 dark:bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 :class="darkMode ? 'text-white' : 'text-slate-900'" class="text-xl font-bold mb-3 transition duration-300">{{ __('messages.comp_shop_title') }}</h3>
                        <p :class="darkMode ? 'text-slate-400' : 'text-slate-500'" class="text-sm leading-relaxed font-semibold transition duration-300">{{ __('messages.comp_shop_desc') }}</p>
                    </div>
                </div>

                <!-- ២. សាលាបង្រៀនកុំព្យូទ័រ (School Workspace) -->
                <div :class="darkMode ? 'bg-slate-900/40 border-slate-800 hover:border-emerald-500/40 hover:bg-slate-900/80 shadow-md shadow-slate-950/10' : 'bg-white border-slate-100 hover:border-emerald-500/40 hover:shadow-xl shadow-sm shadow-slate-100'"
                     class="group rounded-3xl p-8 border flex flex-col justify-between hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition duration-300"></div>
                    <div>
                        <div class="w-12 h-12 bg-emerald-500/10 text-emerald-500 dark:bg-emerald-500/20 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 :class="darkMode ? 'text-white' : 'text-slate-900'" class="text-xl font-bold mb-3 transition duration-300">{{ __('messages.school_title') }}</h3>
                        <p :class="darkMode ? 'text-slate-400' : 'text-slate-500'" class="text-sm leading-relaxed font-semibold transition duration-300">{{ __('messages.school_desc') }}</p>
                    </div>
                </div>

                <!-- ៣. ហាងលក់កាហ្វេ (Cafe Workspace) -->
                <div :class="darkMode ? 'bg-slate-900/40 border-slate-800 hover:border-amber-500/40 hover:bg-slate-900/80 shadow-md shadow-slate-950/10' : 'bg-white border-slate-100 hover:border-amber-500/40 hover:shadow-xl shadow-sm shadow-slate-100'"
                     class="group rounded-3xl p-8 border flex flex-col justify-between hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/10 rounded-full blur-2xl group-hover:bg-amber-500/20 transition duration-300"></div>
                    <div>
                        <div class="w-12 h-12 bg-amber-500/10 text-amber-500 dark:bg-amber-500/20 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 8h1a4 4 0 018 0v1a4 4 0 01-4 4h-1M2 8h14v5a4 4 0 01-4 4H6a4 4 0 01-4-4V8z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 3v3M10 3v3" />
                            </svg>
                        </div>
                        <h3 :class="darkMode ? 'text-white' : 'text-slate-900'" class="text-xl font-bold mb-3 transition duration-300">{{ __('messages.coffee_shop') }}</h3>
                        <p :class="darkMode ? 'text-slate-400' : 'text-slate-500'" class="text-sm leading-relaxed font-semibold transition duration-300">{{ __('messages.coffee_desc') }}</p>
                    </div>
                </div>

                <!-- ៤. ផ្ទុកឯកសារ និងមេរៀន (Library Workspace) -->
                <div :class="darkMode ? 'bg-slate-900/40 border-slate-800 hover:border-purple-500/40 hover:bg-slate-900/80 shadow-md shadow-slate-950/10' : 'bg-white border-slate-100 hover:border-purple-500/40 hover:shadow-xl shadow-sm shadow-slate-100'"
                     class="group rounded-3xl p-8 border flex flex-col justify-between hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition duration-300"></div>
                    <div>
                        <div class="w-12 h-12 bg-purple-500/10 text-purple-500 dark:bg-purple-500/20 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg>
                        </div>
                        <h3 :class="darkMode ? 'text-white' : 'text-slate-900'" class="text-xl font-bold mb-3 transition duration-300">{{ __('messages.library_title') }}</h3>
                        <p :class="darkMode ? 'text-slate-400' : 'text-slate-500'" class="text-sm leading-relaxed font-semibold transition duration-300">{{ __('messages.library_desc') }}</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ៤. ផ្នែក Footer (ខាងក្រោមបង្អស់) -->
    <footer :class="darkMode ? 'bg-slate-950 border-slate-900 text-slate-500 shadow-inner' : 'bg-slate-100/80 border-slate-200/80 text-slate-500'"
            class="border-t py-8 px-4 text-center text-sm transition-colors duration-300 backdrop-blur-md">
        <p class="font-semibold tracking-wide">{{ __('messages.copyright') }}</p>
    </footer>

</body>
</html>