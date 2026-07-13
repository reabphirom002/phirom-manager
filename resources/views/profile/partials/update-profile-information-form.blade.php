<section class="space-y-6">
    <header class="flex items-start space-x-4">
        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <div>
            <h2 class="text-lg font-bold text-gray-900">
                {{ __('messages.profile_info') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                {{ __('messages.profile_info_desc') }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <!-- ========================================================================= -->
        <!-- ផ្នែករូបថត Profile (អាចចុចលើរង្វង់មូលដើម្បីអាប់ឡូត ឬចុចលុប) -->
        <!-- ========================================================================= -->
        <div class="flex items-center space-x-6 mb-6 pb-6 border-b border-gray-100">
            <!-- ចុចលើរូបរង្វង់មូលដើម្បី Upload រូបភាពពី PC ភ្លាមៗ -->
            <div class="relative group cursor-pointer" onclick="document.getElementById('edit-avatar-file-input').click()">
                @if($user->avatar)
                    <img src="{{ asset($user->avatar) }}" class="h-20 w-20 rounded-full object-cover border-2 border-indigo-100 group-hover:opacity-75 transition duration-150" alt="Avatar">
                @else
                    <div class="h-20 w-20 rounded-full bg-indigo-600 flex items-center justify-center text-white text-2xl font-bold uppercase group-hover:bg-indigo-700 transition duration-150">
                        {{ Str::limit($user->name, 1, '') }}
                    </div>
                @endif
                <!-- ម៉ាស់ខ្មៅគ្របពីលើពេលយក Mouse ទៅដាក់ចំ (Hover) -->
                <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-150">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    </svg>
                </div>
            </div>

            <div class="space-y-1">
                <!-- ប៊ូតុងប្ដូររូបថត -->
                <button type="button" onclick="document.getElementById('edit-avatar-file-input').click()" class="px-3 py-1.5 bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-lg hover:bg-indigo-100 transition duration-150">
                    {{ __('messages.change_photo') }}
                </button>

                <!-- ប៊ូតុងលុបរូបថត (បង្ហាញតែពេលមានរូបភាពប៉ុណ្ណោះ) -->
                @if($user->avatar)
                    <button type="button" onclick="document.getElementById('avatar-delete-form').submit()" class="px-3 py-1.5 bg-red-50 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-100 transition duration-150 ml-2">
                        {{ __('messages.delete_photo') }}
                    </button>
                @endif
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('messages.name')" class="font-medium text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="name" name="name" type="text" class="block w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            <x-input-error class="mt-1" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('messages.email')" class="font-medium text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <x-text-input id="email" name="email" type="email" class="block w-full border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500" :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-1" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-amber-50 rounded-lg border border-amber-200">
                    <p class="text-xs text-amber-800">
                        {{ __('messages.email_unverified') }}

                        <button form="send-verification" class="ml-1 underline font-semibold text-amber-900 hover:text-amber-700 focus:outline-none">
                            {{ __('messages.resend_verification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-xs font-semibold text-green-600">
                            {{ __('messages.verification_sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <x-primary-button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 rounded-xl transition duration-150 ease-in-out">
                {{ __('messages.save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
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

    <!-- ========================================================================= -->
    <!-- Form លាក់ (Hidden Forms) សម្រាប់ដំណើរការ Upload ស្វ័យប្រវត្ត និងលុបថតចោល -->
    <!-- ========================================================================= -->
    <form id="edit-avatar-upload-form" method="POST" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data" class="hidden">
        @csrf
        <input type="file" id="edit-avatar-file-input" name="avatar" onchange="document.getElementById('edit-avatar-upload-form').submit()" accept="image/*">
    </form>

    @if($user->avatar)
        <form id="avatar-delete-form" method="POST" action="{{ route('profile.avatar.destroy') }}" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif
</section>
