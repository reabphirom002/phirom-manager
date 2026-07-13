<x-guest-layout>
    <!-- រូបតំណាងសោរ និងចំណងជើងទំព័រ (Header Icon & Title) -->
    <div class="flex flex-col items-center mb-6 text-center">
        <div class="p-4 bg-indigo-50 text-indigo-600 rounded-full mb-3 shadow-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-800">
            {{ __('messages.forgot_password_title') }}
        </h2>
        <p class="mt-2 text-sm text-gray-500 leading-relaxed max-w-sm">
            {{ __('messages.forgot_password_text') }}
        </p>
    </div>

    <!-- បង្ហាញសារជូនដំណឹងពេលផ្ញើលីងទៅអ៊ីមែលជោគជ័យ (Session Status) -->
    @if (session('status'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl flex items-center space-x-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- ប្រអប់បញ្ចូលអ៊ីមែល (Email Address) -->
        <div>
            <x-input-label for="email" :value="__('messages.email')" class="font-medium text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                    </svg>
                </div>
                <x-text-input 
                    id="email" 
                    class="block w-full pl-10 border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-sm" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    placeholder="example@gmail.com"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs" />
        </div>

        <!-- ប៊ូតុងសកម្មភាព (Actions) -->
        <div class="space-y-3 pt-2">
            <x-primary-button class="w-full justify-center py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 rounded-xl transition duration-150 ease-in-out text-sm font-semibold tracking-wide">
                {{ __('messages.email_password_reset_link') }}
            </x-primary-button>

            <!-- ប៊ូតុងត្រឡប់ទៅទំព័រ Login វិញ -->
            <div class="text-center">
                <a href="{{ route('login') }}" class="inline-flex items-center text-xs font-semibold text-gray-500 hover:text-indigo-600 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ __('messages.back_to_login') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
