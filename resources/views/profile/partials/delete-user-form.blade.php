<section class="space-y-6">
    <header class="flex items-start space-x-4">
        <div class="p-3 bg-red-100 text-red-600 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.895-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>
        <div>
            <h2 class="text-lg font-bold text-red-600">
                {{ __('messages.delete_account') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                {{ __('messages.delete_desc') }}
            </p>
        </div>
    </header>

    <div class="pt-4 border-t border-red-100/50">
        <x-danger-button
            class="px-5 py-2.5 bg-red-600 hover:bg-red-700 rounded-xl text-xs"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >{{ __('messages.delete_account') }}</x-danger-button>
    </div>

    <!-- Confirmation Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <div class="flex items-start space-x-4 text-left">
                <div class="p-3 bg-red-100 text-red-600 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ __('messages.confirm_delete_title') }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                        {{ __('messages.confirm_delete_desc') }}
                    </p>
                </div>
            </div>

            <div class="mt-6">
                <x-input-label for="password" :value="__('messages.password')" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full sm:w-3/4 border-gray-300 rounded-xl focus:ring-red-500 focus:border-red-500"
                    placeholder="{{ __('messages.password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm" />
            </div>

            <div class="mt-8 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-5 py-2.5 rounded-xl border border-gray-200">
                    {{ __('messages.cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 px-5 py-2.5 bg-red-600 hover:bg-red-700 rounded-xl">
                    {{ __('messages.delete_account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
