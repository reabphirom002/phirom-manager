<x-guest-layout>
    <!-- Header Icon & Title -->
    <div class="flex flex-col items-center mb-6 text-center">
        <div class="p-4 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-full mb-3 shadow-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
            {{ app()->getLocale() == 'km' ? 'ចុះឈ្មោះគណនីថ្មី' : 'Create New Account' }}
        </h2>
        <p class="mt-1.5 text-xs text-gray-500 dark:text-slate-400">
            {{ app()->getLocale() == 'km' ? 'បំពេញព័ត៌មានខាងក្រោមដើម្បីបង្កើតគណនី' : 'Fill in the information below to register.' }}
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="app()->getLocale() == 'km' ? 'ឈ្មោះពេញ' : 'Full Name'" class="font-semibold text-gray-700 dark:text-slate-300" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input id="name" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="app()->getLocale() == 'km' ? 'អាសយដ្ឋានអ៊ីមែល' : 'Email Address'" class="font-semibold text-gray-700 dark:text-slate-300" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                    </svg>
                </div>
                <x-text-input id="email" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="example@gmail.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="app()->getLocale() == 'km' ? 'ពាក្យសម្ងាត់' : 'Password'" class="font-semibold text-gray-700 dark:text-slate-300" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="app()->getLocale() == 'km' ? 'បញ្ជាក់ពាក្យសម្ងាត់' : 'Confirm Password'" class="font-semibold text-gray-700 dark:text-slate-300" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Action Buttons -->
        <div class="space-y-4 pt-3">
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-lg shadow-indigo-600/10">
                {{ app()->getLocale() == 'km' ? 'ចុះឈ្មោះគណនី' : 'Register Account' }}
            </x-primary-button>

            <div class="text-center">
                <span class="text-xs text-gray-500">{{ app()->getLocale() == 'km' ? 'មានគណនីរួចហើយមែនទេ?' : 'Already registered?' }}</span>
                <a href="{{ route('login') }}" class="text-xs font-bold text-indigo-500 hover:text-indigo-600 ml-1">
                    {{ app()->getLocale() == 'km' ? 'ចូលប្រើប្រាស់' : 'Log In' }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>