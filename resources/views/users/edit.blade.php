<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-amber-500/10 rounded-2xl">
                    <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <h2 class="font-black text-2xl tracking-tight text-slate-800 dark:text-white uppercase">{{ __('messages.edit_user') }}</h2>
            </div>
            <a href="{{ route('users.index') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-black rounded-xl text-xs hover:bg-slate-200 transition-all duration-150">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12 relative z-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 dark:bg-slate-900/40 backdrop-blur-xl rounded-[2.5rem] border border-slate-200 dark:border-slate-800/60 shadow-2xl p-10">
                
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-8">
                    @csrf @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">{{ __('messages.name') }} *</label>
                            <input type="text" name="name" required class="w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-5 font-bold transition-all" value="{{ $user->name }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">{{ __('messages.email') }} *</label>
                            <input type="email" name="email" required class="w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-5 font-bold transition-all" value="{{ $user->email }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">{{ __('messages.password') }} (Optional)</label>
                                <input type="password" name="password" placeholder="Leave blank to keep current" class="w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-5 font-bold transition-all">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">{{ __('messages.role') }} *</label>
                                <select name="role" required class="w-full rounded-2xl border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 py-4 px-5 font-bold transition-all cursor-pointer">
                                    <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>{{ __('messages.student') }}</option>
                                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>{{ __('messages.staff') }}</option>
                                    <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>{{ __('messages.admin') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black rounded-2xl shadow-xl shadow-blue-500/20 hover:opacity-90 transition-all transform active:scale-[0.98]">
                        {{ __('messages.edit_user') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>