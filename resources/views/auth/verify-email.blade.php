<x-guest-layout>
    <!-- Header Icon & Title -->
    <div class="flex flex-col items-center mb-6 text-center">
        <div class="p-4 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-full mb-3 shadow-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
            {{ app()->getLocale() == 'km' ? 'សូមផ្ទៀងផ្ទាត់អ៊ីមែលរបស់អ្នក' : 'Verify Your Email' }}
        </h2>
        <p class="mt-2 text-xs text-gray-500 dark:text-slate-400 leading-relaxed">
            {{ app()->getLocale() == 'km' ? 'សូមអរគុណសម្រាប់ការចុះឈ្មោះ! មុនពេលចាប់ផ្ដើម សូមចូលទៅកាន់អ៊ីមែលរបស់អ្នក រួចចុចលើលីងផ្ទៀងផ្ទាត់ដែលយើងទើបតែបានផ្ញើជូន។ ប្រសិនបើអ្នករកមិនឃើញ សូមចុចប៊ូតុងខាងក្រោមដើម្បីផ្ញើម្ដងទៀត។' : 'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.' }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-xs font-semibold flex items-center space-x-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ app()->getLocale() == 'km' ? 'លីងផ្ទៀងផ្ទាត់ថ្មីមួយ ត្រូវបានផ្ញើទៅកាន់អាសយដ្ឋានអ៊ីមែលដែលអ្នកបានផ្ដល់ឱ្យនៅពេលចុះឈ្មោះរួចរាល់ហើយ។' : 'A new verification link has been sent to the email address you provided during registration.' }}</span>
        </div>
    @endif

    <div class="flex flex-col space-y-4">
        <!-- ផ្ញើលីងម្ដងទៀត -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full justify-center py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm shadow-lg shadow-emerald-600/10">
                {{ app()->getLocale() == 'km' ? 'ផ្ញើលីងផ្ទៀងផ្ទាត់ម្ដងទៀត' : 'Resend Verification Email' }}
            </x-primary-button>
        </form>

        <!-- ចាកចេញពីគណនី -->
        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-xs font-bold text-gray-500 hover:text-red-500 transition duration-150 underline decoration-gray-300 hover:decoration-red-500 underline-offset-4">
                {{ __('messages.logout') }}
            </button>
        </form>
    </div>
</x-guest-layout>