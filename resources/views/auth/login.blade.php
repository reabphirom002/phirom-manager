<x-guest-layout>
    <!-- Header Icon & Title -->
    <div class="flex flex-col items-center mb-6 text-center">
        <div class="p-4 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-full mb-3 shadow-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
            {{ app()->getLocale() == 'km' ? 'ចូលប្រើប្រាស់គណនី' : 'Sign In Account' }}
        </h2>
        <p class="mt-1.5 text-xs text-gray-500 dark:text-slate-400">
            {{ app()->getLocale() == 'km' ? 'សូមបញ្ចូលអ៊ីមែល និងលេខសម្ងាត់របស់អ្នកដើម្បីចូល' : 'Please enter your email and password to log in.' }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="app()->getLocale() == 'km' ? 'អាសយដ្ឋានអ៊ីមែល' : 'Email Address'" class="font-semibold text-gray-700 dark:text-slate-300" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                    </svg>
                </div>
                <x-text-input id="email" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="example@gmail.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="app()->getLocale() == 'km' ? 'ពាក្យសម្ងាត់' : 'Password'" class="font-semibold text-gray-700 dark:text-slate-300" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-gray-500 hover:text-indigo-500 transition duration-150" href="{{ route('password.request') }}">
                        {{ app()->getLocale() == 'km' ? 'ភ្លេចពាក្យសម្ងាត់?' : 'Forgot password?' }}
                    </a>
                @endif
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-slate-950 border-gray-300 dark:border-slate-800 text-indigo-600 focus:ring-indigo-500 shadow-sm" name="remember">
                <span class="ms-2 text-xs font-semibold text-gray-500 dark:text-slate-400">{{ app()->getLocale() == 'km' ? 'ចងចាំខ្ញុំ' : 'Remember me' }}</span>
            </label>
        </div>

        <!-- Action Button -->
        <div class="space-y-4 pt-2">
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-lg shadow-indigo-600/10">
                {{ app()->getLocale() == 'km' ? 'ចូលប្រើប្រាស់' : 'Log In' }}
            </x-primary-button>

            @if (Route::has('register'))
                <div class="text-center">
                    <span class="text-xs text-gray-500">{{ app()->getLocale() == 'km' ? 'មិនទាន់មានគណនីមែនទេ?' : "Don't have an account?" }}</span>
                    <a href="{{ route('register') }}" class="text-xs font-bold text-indigo-500 hover:text-indigo-600 ml-1">
                        {{ app()->getLocale() == 'km' ? 'ចុះឈ្មោះឥឡូវនេះ' : 'Register Now' }}
                    </a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>