<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PHIROM MANAGER</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Kantumruy Pro', sans-serif; } </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col md:flex-row">

    <!-- ចំហៀងខាងឆ្វេង៖ ផ្ទាំងម៉ាកសញ្ញាក្រុមហ៊ុន (Brand Banner) -->
    <div class="hidden md:flex md:w-1/2 bg-gradient-to-tr from-blue-600 to-indigo-800 text-white flex-col justify-between p-12">
        <div class="flex items-center space-x-2">
            <span class="text-2xl font-bold tracking-wider">PHIROM MANAGER</span>
        </div>
        <div class="space-y-4">
            <h1 class="text-4xl font-bold leading-tight">{{ __('messages.welcome_title') }}</h1>
            <p class="text-blue-100 text-lg">{{ __('messages.welcome_subtitle') }}</p>
        </div>
        <p class="text-sm text-blue-200">&copy; {{ date('Y') }} PHIROM MANAGER.</p>
    </div>

    <!-- ចំហៀងខាងស្ដាំ៖ ទម្រង់បំពេញព័ត៌មាន Login -->
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 sm:p-12 md:p-16 relative bg-white">
        
        <!-- ប៊ូតុងប្ដូរភាសា -->
        <div class="absolute top-5 right-5 space-x-1">
            <a href="{{ route('lang.switch', 'km') }}" class="px-2.5 py-1 text-xs font-semibold rounded {{ app()->getLocale() == 'km' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}">ខ្មែរ</a>
            <a href="{{ route('lang.switch', 'en') }}" class="px-2.5 py-1 text-xs font-semibold rounded {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' }}">EN</a>
        </div>

        <div class="w-full max-w-md space-y-8">
            <!-- ឡូហ្គោជារង្វង់មូលផ្ទាល់ខ្លួន (Circular Logo) -->
            <div class="text-center">
                <!-- បើលោកអ្នកមានរូបភាពនៅក្នុង public/images/logo.png សូមបើកកូដ <img> ខាងក្រោមនេះ -->
                <img class="w-24 h-24 rounded-full object-cover mx-auto shadow-md border-4 border-blue-100" src="{{ asset('images/logo.png') }}" alt="Logo">
                
                <!-- ឡូហ្គោបណ្ដោះអាសន្នជាអក្សរក្នុងរង្វង់មូលស្អាត (លុបចេញពេលមានរូបភាព) -->
                <!-- <div class="w-24 h-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-3xl font-bold mx-auto shadow-lg border-4 border-blue-100">PM</div> -->
                
                <h2 class="mt-6 text-2xl font-bold text-gray-900">{{ __('messages.login') }}</h2>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="space-y-4">
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.email') }}</label>
                        <input id="email" name="email" type="email" required autofocus class="appearance-none rounded-lg relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.password') }}</label>
                        <input id="password" name="password" type="password" required class="appearance-none rounded-lg relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">{{ __('messages.remember_me') }}</label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">{{ __('messages.forgot_password') }}</a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition duration-150">
                        {{ __('messages.login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>