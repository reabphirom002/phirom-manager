<section class="space-y-6">
    <header class="flex items-start space-x-4">
        <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <div>
            <h2 class="text-lg font-bold text-gray-900">
                {{ __('messages.update_password') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                {{ __('messages.password_desc') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('messages.current_password')" class="font-medium text-gray-700" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('messages.new_password')" class="font-medium text-gray-700" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('messages.confirm_password')" class="font-medium text-gray-700" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <x-primary-button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 rounded-xl transition duration-150 ease-in-out">
                {{ __('messages.save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:leave="transition ease-in duration-1000"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center space-x-1.5 text-sm text-emerald-600"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ __('messages.saved') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>
