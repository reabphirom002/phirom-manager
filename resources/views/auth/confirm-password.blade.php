<x-guest-layout>
    <!-- Header Icon & Title -->
    <div class="flex flex-col items-center mb-6 text-center">
        <div class="p-4 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 rounded-full mb-3 shadow-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
            {{ app()->getLocale() == 'km' ? 'តំបន់មានសុវត្ថិភាពខ្ពស់' : 'Secure Area' }}
        </h2>
        <p class="mt-1.5 text-xs text-gray-500 dark:text-slate-400 leading-relaxed">
            {{ app()->getLocale() == 'km' ? 'នេះជាតំបន់សុវត្ថិភាពនៃប្រព័ន្ធ។ សូមបញ្ជាក់ពាក្យសម្ងាត់របស់អ្នកជាមុនសិន មុននឹងបន្តទៅមុខ។' : 'This is a secure area of the application. Please confirm your password before continuing.' }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('messages.password')" class="font-semibold text-gray-700 dark:text-slate-300" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                <x-text-input id="password" class="block w-full pl-10 border-gray-300 dark:border-slate-800 rounded-xl text-sm dark:bg-slate-950 dark:text-white" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs" />
        </div>

        <div class="pt-3">
            <x-primary-button class="w-full justify-center py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm shadow-lg shadow-red-600/10">
                {{ app()->getLocale() == 'km' ? 'បញ្ជាក់ពាក្យសម្ងាត់' : 'Confirm Password' }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>