<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-blue-500/10 rounded-2xl">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-slate-800 dark:text-white uppercase">{{ __('messages.add_user') }}</h2>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-1 italic">Create Member Account</p>
                </div>
            </div>
            <a href="{{ route('users.index') }}" class="px-6 py-3 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black rounded-2xl text-xs hover:bg-slate-200 transition-all duration-200 shadow-sm border border-slate-200 dark:border-slate-700">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12 relative z-10 font-sans">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 dark:bg-slate-900/40 backdrop-blur-xl rounded-[3rem] border border-slate-200 dark:border-slate-800/60 shadow-2xl p-10 sm:p-14">
                
                <form action="{{ route('users.store') }}" method="POST" class="space-y-10">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- ឈ្មោះសមាជិក -->
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-[0.2em] ml-2">{{ __('messages.name') }} *</label>
                            <input type="text" name="name" required placeholder="បញ្ចូលឈ្មោះពេញរបស់សមាជិក..." class="w-full rounded-[1.5rem] border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-800 dark:text-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4.5 px-6 font-bold shadow-sm transition-all" value="{{ old('name') }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2 ml-2" />
                        </div>

                        <!-- អាសយដ្ឋានអ៊ីមែល -->
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-[0.2em] ml-2">{{ __('messages.email') }} *</label>
                            <input type="email" name="email" required placeholder="បញ្ចូលអាសយដ្ឋានអ៊ីមែល..." class="w-full rounded-[1.5rem] border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-800 dark:text-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4.5 px-6 font-bold shadow-sm transition-all" value="{{ old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-2" />
                        </div>

                        <!-- លេខសម្ងាត់ -->
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-[0.2em] ml-2">{{ __('messages.password') }} *</label>
                            <input type="password" name="password" required placeholder="យ៉ាងហោចណាស់ ៨ ខ្ទង់..." class="w-full rounded-[1.5rem] border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-800 dark:text-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4.5 px-6 font-bold shadow-sm transition-all">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 ml-2" />
                        </div>

                        <!-- ជ្រើសរើសសិទ្ធិប្រើប្រាស់ -->
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-[0.2em] ml-2">{{ __('messages.role') }} *</label>
                            <select name="role" required class="w-full rounded-[1.5rem] border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-800 dark:text-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4.5 px-6 font-bold shadow-sm transition-all cursor-pointer">
                                <option value="student">{{ __('messages.student') }} (Client)</option>
                                <option value="staff">{{ __('messages.staff') }} (Employee)</option>
                                <option value="manager">Manager (High Level)</option>
                                <option value="admin">{{ __('messages.admin') }} (Full Access)</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-5 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white font-black rounded-[1.8rem] shadow-2xl shadow-blue-500/20 hover:opacity-90 transition-all transform active:scale-[0.98] uppercase tracking-[0.2em] text-sm">
                            {{ __('messages.add_user') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>