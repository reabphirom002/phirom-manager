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
    </style>
</head>
<!-- កំណត់ x-data សម្រាប់គ្រប់គ្រង Dark/Light Mode (លំនាំដើមយក Dark Mode: true) -->
<body x-data="{ darkMode: localStorage.getItem('darkMode') !== 'false' }" 
      :class="darkMode ? 'bg-slate-900 text-slate-100' : 'bg-gray-50 text-slate-800'"
      class="antialiased min-h-screen flex flex-col justify-between transition-colors duration-300">

    <!-- ១. របារម៉ឺនុយខាងលើ (Header Navigation) -->
    <header :class="darkMode ? 'bg-slate-900/80 border-slate-800 text-white' : 'bg-white/80 border-gray-200 text-slate-800 shadow-sm'"
            class="backdrop-blur-md border-b sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Logo និងឈ្មោះក្រុមហ៊ុន -->
            <div class="flex items-center space-x-3">
                <img class="h-10 w-10 rounded-full object-cover border-2 border-blue-500 shadow-lg" src="{{ asset('images/logo.png') }}" alt="Logo">
                <span :class="darkMode ? 'from-blue-400 to-indigo-400' : 'from-blue-600 to-indigo-600'"
                      class="text-xl font-bold tracking-wider bg-gradient-to-r bg-clip-text text-transparent">PHIROM MANAGER</span>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- ប៊ូតុងប្ដូរពន្លឺ (Theme Switcher Button) -->
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                        :class="darkMode ? 'bg-slate-800 border-slate-700 text-slate-300 hover:text-white' : 'bg-gray-100 border-gray-200 text-gray-600 hover:text-gray-900'"
                        class="p-2.5 rounded-xl border transition duration-150 focus:outline-none"
                        title="ប្ដូរពន្លឺ">
                    <span x-show="darkMode">☀️</span>
                    <span x-show="!darkMode" x-cloak>🌙</span>
                </button>

                <!-- ប៊ូតុងប្ដូរភាសា (ខ្មែរ / EN) -->
                <div :class="darkMode ? 'bg-slate-800 border-slate-700' : 'bg-gray-100 border-gray-200'"
                     class="flex p-1 rounded-xl border">
                    <a href="{{ route('lang.switch', 'km') }}" class="px-3 py-1.5 text-xs font-semibold rounded-lg transition duration-150 {{ app()->getLocale() == 'km' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">ខ្មែរ</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1.5 text-xs font-semibold rounded-lg transition duration-150 {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">EN</a>
                </div>

                <!-- ប៊ូតុង Login / Register -->
                <div class="flex items-center space-x-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 transition duration-150">{{ __('messages.go_to_dashboard') }}</a>
                        @else
                            <a href="{{ route('login') }}" :class="darkMode ? 'text-slate-400 hover:text-white' : 'text-gray-600 hover:text-gray-900'" class="text-sm font-medium transition duration-150 px-2">{{ __('messages.login') }}</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl shadow-lg hover:bg-blue-700 transition duration-150">{{ __('messages.register') }}</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- ២. ផ្នែកខាងលើបង្អស់ (Hero Section) -->
    <main class="flex-grow">
        <section class="relative py-24 sm:py-32 overflow-hidden">
            <!-- ពន្លឺ Mesh Gradient ប្រែប្រួលទៅតាម Dark/Light Mode -->
            <div :class="darkMode ? 'bg-blue-600/10' : 'bg-blue-500/5'" class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full blur-3xl -z-10 transition duration-300"></div>
            <div :class="darkMode ? 'bg-purple-600/10' : 'bg-purple-500/5'" class="absolute top-1/3 left-1/3 w-[300px] h-[300px] rounded-full blur-3xl -z-10 transition duration-300"></div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
                <span :class="darkMode ? 'bg-blue-500/10 text-blue-400 border-blue-500/20' : 'bg-blue-50 text-blue-600 border-blue-100'"
                      class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full border inline-block shadow-sm">PHIROM MANAGER</span>
                
                <h1 :class="darkMode ? 'from-white to-slate-400' : 'from-slate-900 to-slate-600'"
                    class="text-4xl sm:text-6xl font-bold tracking-tight leading-tight bg-gradient-to-b bg-clip-text text-transparent transition duration-300">
                    {{ __('messages.welcome_title') }}
                </h1>
                
                <p :class="darkMode ? 'text-slate-400' : 'text-gray-600'" 
                   class="text-lg sm:text-xl max-w-3xl mx-auto leading-relaxed transition duration-300">
                    {{ __('messages.welcome_subtitle') }}
                </p>
                
                <div class="pt-4">
                    <a href="{{ route('login') }}" class="px-8 py-4 text-base font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-2xl shadow-xl shadow-blue-600/20 transition duration-150 inline-block">
                        {{ __('messages.learn_more') }} &rarr;
                    </a>
                </div>
            </div>
        </section>

        <!-- ៣. ផ្នែកបង្ហាញកាតសេវាកម្មទាំង ៤ -->
        <section id="businesses" class="py-16 px-4 max-w-7xl mx-auto space-y-16">
            <div class="text-center space-y-4">
                <h2 :class="darkMode ? 'text-white' : 'text-gray-900'" class="text-3xl font-bold sm:text-4xl transition duration-300">{{ __('messages.our_services') }}</h2>
                <p :class="darkMode ? 'text-slate-400' : 'text-gray-600'" class="max-w-2xl mx-auto text-sm sm:text-base transition duration-300">{{ __('messages.our_services_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- ១. ហាងលក់កុំព្យូទ័រ -->
                <div :class="darkMode ? 'bg-slate-800/40 border-slate-800 hover:border-blue-500/40 hover:bg-slate-800/60' : 'bg-white border-gray-200 hover:border-blue-500/40 hover:shadow-md'"
                     class="rounded-3xl p-8 border flex flex-col justify-between hover:-translate-y-1 transition duration-300">
                    <div>
                        <div class="w-12 h-12 bg-blue-500/10 text-blue-500 rounded-2xl flex items-center justify-center mb-6 text-xl shadow-inner">📦</div>
                        <h3 :class="darkMode ? 'text-white' : 'text-gray-900'" class="text-xl font-bold mb-3 transition duration-300">{{ __('messages.comp_shop_title') }}</h3>
                        <p :class="darkMode ? 'text-slate-400' : 'text-gray-600'" class="text-sm leading-relaxed transition duration-300">{{ __('messages.comp_shop_desc') }}</p>
                    </div>
                </div>

                <!-- ២. សាលាបង្រៀនកុំព្យូទ័រ -->
                <div :class="darkMode ? 'bg-slate-800/40 border-slate-800 hover:border-green-500/40 hover:bg-slate-800/60' : 'bg-white border-gray-200 hover:border-green-500/40 hover:shadow-md'"
                     class="rounded-3xl p-8 border flex flex-col justify-between hover:-translate-y-1 transition duration-300">
                    <div>
                        <div class="w-12 h-12 bg-green-500/10 text-green-500 rounded-2xl flex items-center justify-center mb-6 text-xl shadow-inner">👨‍🎓</div>
                        <h3 :class="darkMode ? 'text-white' : 'text-gray-900'" class="text-xl font-bold mb-3 transition duration-300">{{ __('messages.school_title') }}</h3>
                        <p :class="darkMode ? 'text-slate-400' : 'text-gray-600'" class="text-sm leading-relaxed transition duration-300">{{ __('messages.school_desc') }}</p>
                    </div>
                </div>

                <!-- ៣. ហាងលក់កាហ្វេ -->
                <div :class="darkMode ? 'bg-slate-800/40 border-slate-800 hover:border-amber-500/40 hover:bg-slate-800/60' : 'bg-white border-gray-200 hover:border-amber-500/40 hover:shadow-md'"
                     class="rounded-3xl p-8 border flex flex-col justify-between hover:-translate-y-1 transition duration-300">
                    <div>
                        <div class="w-12 h-12 bg-amber-500/10 text-amber-500 rounded-2xl flex items-center justify-center mb-6 text-xl shadow-inner">🍹</div>
                        <h3 :class="darkMode ? 'text-white' : 'text-gray-900'" class="text-xl font-bold mb-3 transition duration-300">{{ __('messages.coffee_shop') }}</h3>
                        <p :class="darkMode ? 'text-slate-400' : 'text-gray-600'" class="text-sm leading-relaxed transition duration-300">{{ __('messages.coffee_desc') }}</p>
                    </div>
                </div>

                <!-- ៤. ផ្ទុកឯកសារ និងមេរៀន -->
                <div :class="darkMode ? 'bg-slate-800/40 border-slate-800 hover:border-purple-500/40 hover:bg-slate-800/60' : 'bg-white border-gray-200 hover:border-purple-500/40 hover:shadow-md'"
                     class="rounded-3xl p-8 border flex flex-col justify-between hover:-translate-y-1 transition duration-300">
                    <div>
                        <div class="w-12 h-12 bg-purple-500/10 text-purple-500 rounded-2xl flex items-center justify-center mb-6 text-xl shadow-inner">📄</div>
                        <h3 :class="darkMode ? 'text-white' : 'text-gray-900'" class="text-xl font-bold mb-3 transition duration-300">{{ __('messages.library_title') }}</h3>
                        <p :class="darkMode ? 'text-slate-400' : 'text-gray-600'" class="text-sm leading-relaxed transition duration-300">{{ __('messages.library_desc') }}</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ៤. ផ្នែក Footer (ខាងក្រោមបង្អស់) -->
    <footer :class="darkMode ? 'bg-slate-950 border-slate-800 text-slate-500' : 'bg-gray-100 border-gray-200 text-gray-500'"
            class="border-t py-8 px-4 text-center text-sm transition-colors duration-300">
        <p>&copy; {{ date('Y') }} PHIROM MANAGER. {{ __('messages.rights_reserved') }}</p>
    </footer>

</body>
</html>