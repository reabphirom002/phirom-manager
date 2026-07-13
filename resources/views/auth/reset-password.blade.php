<x-guest-layout>
    <!-- Header Icon & Title -->
    <div class="flex flex-col items-center mb-6 text-center">
        <div class="p-4 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-full mb-3 shadow-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
            {{ app()->getLocale() == 'km' ? 'កំណត់ពាក្យសម្ងាត់ថ្មី' : 'Reset Password' }}
        </h2>
        <p class="mt-1.5 text-xs text-gray-500 dark:text-slate-400">
            {{ app()->getLocale() == 'km' ? 'សូមបញ្ចូលពាក្យសម្ងាត់ថ្មីរបស់អ្នកខាងក្រោម។' : 'Please enter your new password below.' }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('messages.email')" class="font-semibold text-gray-700 dark:text-slate-300" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
                </div>
                <x-text-input id="email" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('messages.password')" class="font-semibold text-gray-700 dark:text-slate-300" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                <x-text-input id="password" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('messages.confirm_password')" class="font-semibold text-gray-700 dark:text-slate-300" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                <x-text-input id="password_confirmation" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs" />
        </div>

        <!-- Action Buttons -->
        <div class="pt-3">
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-lg shadow-indigo-600/10">
                {{ app()->getLocale() == 'km' ? 'រក្សាទុកពាក្យសម្ងាត់ថ្មី' : 'Reset Password' }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>