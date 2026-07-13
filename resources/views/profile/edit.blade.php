<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div class="p-2 bg-indigo-500/10 rounded-lg">
                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h2 class="font-black text-2xl tracking-tight text-slate-800 dark:text-white transition-colors duration-150">
                {{ __('messages.account_settings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- ១. Summary Profile Header Banner (Premium Visualization) -->
            <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/20 dark:border-slate-800/50 transition-all duration-300">
                <!-- Background Image & Gradient -->
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1557683316-973673baf926?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover opacity-50 dark:opacity-30" alt="Cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-blue-700 to-slate-900 mix-blend-multiply dark:mix-blend-normal opacity-90"></div>
                </div>

                <div class="relative z-10 p-8 sm:p-12 flex flex-col sm:flex-row items-center space-y-6 sm:space-y-0 sm:space-x-10">
                    <!-- Avatar Logic -->
                    <div class="relative group">
                        <div class="absolute -inset-1.5 bg-white/30 rounded-full blur opacity-40 group-hover:opacity-70 transition duration-300"></div>
                        @if($user->avatar)
                            <img src="{{ asset($user->avatar) }}" class="relative w-28 h-28 rounded-full object-cover border-4 border-white shadow-2xl transition transform group-hover:scale-105" alt="Avatar">
                        @else
                            <div class="relative w-28 h-28 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-xl rounded-full border-4 border-white/40 flex items-center justify-center text-4xl font-black text-white shadow-2xl">
                                {{ Str::limit($user->name, 1, '') }}
                            </div>  
                        @endif
                        <!-- Quick Change Button (Trigger from Nav logic) -->
                        <button onclick="document.getElementById('nav-avatar-file-input').click()" class="absolute bottom-1 right-1 bg-white text-indigo-600 p-2 rounded-full shadow-lg hover:bg-indigo-50 transition transform hover:scale-110">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V3z"></path></svg>
                        </button>
                    </div>

                    <div class="text-center sm:text-left space-y-2">
                        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">{{ $user->name }}</h1>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-2 sm:space-y-0">
                            <p class="text-indigo-100/80 text-sm font-bold flex items-center justify-center sm:justify-start">
                                <svg class="w-4 h-4 mr-2 text-indigo-300" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                {{ $user->email }}
                            </p>
                            <span class="inline-flex items-center px-4 py-1 rounded-full text-[10px] font-black bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 uppercase tracking-widest">
                                <span class="w-1.5 h-1.5 mr-2 bg-emerald-400 rounded-full animate-ping"></span>
                                {{ __('messages.active_account') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ២. Grid Layout for Settings (Glassmorphism Style) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-8">
                    <!-- Update Info Form -->
                    <div class="bg-white/70 dark:bg-slate-900/40 backdrop-blur-xl border border-slate-200 dark:border-slate-800/60 shadow-xl rounded-[2.5rem] p-8 sm:p-10 transition duration-300">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password Form -->
                    <div class="bg-white/70 dark:bg-slate-900/40 backdrop-blur-xl border border-slate-200 dark:border-slate-800/60 shadow-xl rounded-[2.5rem] p-8 sm:p-10 transition duration-300">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <!-- Delete Account Form -->
                    <div class="bg-rose-500/5 dark:bg-rose-500/5 backdrop-blur-xl border border-rose-200/30 dark:border-rose-900/30 shadow-xl rounded-[2.5rem] p-8 sm:p-10 transition duration-300">
                        <div class="max-w-xl">
                            <h3 class="text-rose-600 dark:text-rose-400 font-black text-xl mb-4 uppercase tracking-tighter">{{ __('Delete Account') }}</h3>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                    <!-- Quick Help/Tip Card -->
                    <div class="bg-indigo-600 rounded-[2.5rem] p-8 text-white shadow-xl relative overflow-hidden group">
                        <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition duration-500 text-9xl">🛡️</div>
                        <h4 class="text-lg font-black mb-2 uppercase tracking-widest">Security Tip</h4>
                        <p class="text-indigo-100 text-xs leading-relaxed font-medium">
                            {{ __('messages.security_tip_1') }} ត្រូវប្រាកដថាលោកអ្នកប្រើប្រាស់ពាក្យសម្ងាត់ដែលខ្លាំង ដើម្បីការពារគណនី។
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>