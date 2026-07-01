<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHIROM MANAGER</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Kantumruy Pro', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Header Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-2">
    <!-- រូបភាពឡូហ្គោរង្វង់មូល -->
            <img class="h-9 w-9 rounded-full object-cover border border-gray-200 shadow-sm" src="{{ asset('images/logo.png') }}" alt="Logo">
            <span class="text-2xl font-bold text-blue-600 tracking-wider">PHIROM MANAGER</span>
        </div>
                    
            <div class="flex items-center space-x-6">
                <!-- ប៊ូតុងប្ដូរភាសា (ខ្មែរ / EN) -->
                <div class="flex space-x-1">
                    <a href="{{ route('lang.switch', 'km') }}" class="px-2.5 py-1 text-xs font-semibold rounded {{ app()->getLocale() == 'km' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}">ខ្មែរ</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="px-2.5 py-1 text-xs font-semibold rounded {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}">EN</a>
                </div>

                <!-- ប៊ូតុង Login / Register -->
                <div class="flex items-center space-x-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">{{ __('messages.go_to_dashboard') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">{{ __('messages.login') }}</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">{{ __('messages.register') }}</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl sm:text-5xl font-bold mb-6 leading-tight">{{ __('messages.welcome_title') }}</h1>
            <p class="text-lg sm:text-xl text-blue-100 mb-8 max-w-2xl mx-auto">{{ __('messages.welcome_subtitle') }}</p>
            <div class="space-x-4">
                <a href="#businesses" class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-gray-100 transition">{{ __('messages.learn_more') }}</a>
            </div>
        </div>
    </section>

    <!-- Businesses Section -->
    <section id="businesses" class="py-16 px-4 max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.our_services') }}</h2>
            <p class="text-gray-600 max-w-xl mx-auto">{{ __('messages.our_services_subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- 1. Computer Shop -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                <div class="p-6">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('messages.comp_shop_title') }}</h3>
                    <p class="text-gray-600 text-sm">{{ __('messages.comp_shop_desc') }}</p>
                </div>
            </div>

            <!-- 2. Computer School -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                <div class="p-6">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('messages.school_title') }}</h3>
                    <p class="text-gray-600 text-sm">{{ __('messages.school_desc') }}</p>
                </div>
            </div>

            <!-- 3. Coffee Shop -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                <div class="p-6">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('messages.coffee_title') }}</h3>
                    <p class="text-gray-600 text-sm">{{ __('messages.coffee_desc') }}</p>
                </div>
            </div>

            <!-- 4. Library -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                <div class="p-6">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('messages.library_title') }}</h3>
                    <p class="text-gray-600 text-sm">{{ __('messages.library_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 px-4 text-center">
        <p class="text-sm">&copy; {{ date('Y') }} PHIROM MANAGER. {{ __('messages.rights_reserved') }}</p>
    </footer>

</body>
</html>