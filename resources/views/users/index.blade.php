<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div class="p-3 bg-indigo-500/10 rounded-2xl shadow-inner">
                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <h2 class="font-black text-2xl sm:text-3xl tracking-tight text-slate-800 dark:text-white uppercase">
                    {{ app()->getLocale() == 'km' ? 'គ្រប់គ្រងគណនីសមាជិក' : 'User Management' }}
                </h2>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mt-1 italic">Enterprise Access & Control Center</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative z-10 font-sans transition-all duration-150">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 rounded-[1.5rem] text-sm font-black flex items-center backdrop-blur-md animate-fade-in shadow-sm">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- ១. ផ្ទាំងប៊ូតុងបង្កើតសមាជិក (Hero Action Card - អក្សរធំច្បាស់ល្អ) -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-[2.5rem] p-1 shadow-2xl">
                <div class="bg-white/95 dark:bg-slate-900/90 backdrop-blur-xl rounded-[2.4rem] p-8 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex items-center space-x-6 text-center md:text-left">
                        <div class="hidden sm:flex w-24 h-24 bg-blue-500/10 rounded-[2rem] items-center justify-center text-5xl shadow-inner border border-blue-500/10">
                            👤
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-slate-800 dark:text-white leading-tight">
                                {{ app()->getLocale() == 'km' ? 'បង្កើតគណនីសមាជិកថ្មី' : 'Create New Member' }}
                            </h3>
                            <p class="text-base font-bold text-slate-500 mt-2 italic">
                                {{ app()->getLocale() == 'km' ? 'បន្ថែមបុគ្គលិក ឬសិស្សថ្មីចូលក្នុងប្រព័ន្ធគ្រប់គ្រង' : 'Add new staff or students into the management system' }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- ប៊ូតុង Add User -->
                    <a href="{{ route('users.create') }}" class="w-full md:w-auto px-12 py-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black rounded-2xl text-lg shadow-2xl shadow-blue-500/40 hover:opacity-90 transition transform hover:-translate-y-1 active:scale-95 flex items-center justify-center space-x-3 group">
                        <span class="text-3xl font-light group-hover:rotate-90 transition-transform duration-300">+</span>
                        <span class="tracking-widest uppercase">{{ app()->getLocale() == 'km' ? 'បន្ថែមសមាជិក' : 'Add Member' }}</span>
                    </a>
                </div>
            </div>

            <!-- ២. តារាងម៉ាទ្រីសសិទ្ធិ (Global RBAC Matrix) -->
            <div class="bg-white/60 dark:bg-slate-900/40 backdrop-blur-xl rounded-[2.5rem] border border-slate-200 dark:border-slate-800/60 shadow-2xl overflow-hidden">
                <div class="p-8 border-b border-slate-100 dark:border-slate-800/60 bg-gradient-to-r from-slate-50/50 to-transparent dark:from-slate-800/20 flex items-center justify-between">
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white flex items-center">
                        <span class="p-2.5 bg-indigo-500/10 rounded-xl mr-4">🛡️</span> 
                        {{ app()->getLocale() == 'km' ? 'គ្រប់គ្រងសិទ្ធិប្រើប្រាស់សកល' : 'Global Permission Matrix' }}
                    </h3>
                </div>

                <form method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-100/50 dark:bg-slate-800/50">
                                    <th class="px-8 py-6 text-xs font-black uppercase tracking-[0.2em] text-slate-500">{{ app()->getLocale() == 'km' ? 'សិទ្ធិអនុញ្ញាត' : 'Permissions' }}</th>
                                    <th class="px-6 py-6 text-center font-black text-[11px] uppercase tracking-widest text-slate-900 dark:text-white">Admin / Owner</th>
                                    <th class="px-6 py-6 text-center font-black text-[11px] uppercase tracking-widest text-indigo-500">Manager</th>
                                    <th class="px-6 py-6 text-center font-black text-[11px] uppercase tracking-widest text-emerald-500">Staff</th>
                                    <th class="px-6 py-6 text-center font-black text-[11px] uppercase tracking-widest text-slate-400">Client</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60">
                                @foreach($permissions as $key => $label)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition duration-150">
                                        <td class="px-8 py-5">
                                            <div class="font-black text-slate-800 dark:text-slate-200 text-base">{{ $label }}</div>
                                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">{{ str_replace('_', ' ', $key) }}</div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-500 flex items-center justify-center mx-auto">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <input type="checkbox" name="perm_manager_{{ $key }}" value="1" class="w-6 h-6 rounded-lg border-slate-300 dark:border-slate-700 text-indigo-600 focus:ring-indigo-500 transition cursor-pointer bg-white dark:bg-slate-900" {{ \App\Models\Setting::check('perm_manager_' . $key) ? 'checked' : '' }}>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <input type="checkbox" name="perm_staff_{{ $key }}" value="1" class="w-6 h-6 rounded-lg border-slate-300 dark:border-slate-700 text-emerald-600 focus:ring-emerald-500 transition cursor-pointer bg-white dark:bg-slate-900" {{ \App\Models\Setting::check('perm_staff_' . $key) ? 'checked' : '' }}>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <input type="checkbox" name="perm_client_{{ $key }}" value="1" class="w-6 h-6 rounded-lg border-slate-300 dark:border-slate-700 text-slate-400 focus:ring-slate-500 transition cursor-pointer bg-white dark:bg-slate-900" {{ \App\Models\Setting::check('perm_client_' . $key) ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-8 bg-slate-50/50 dark:bg-slate-800/30 flex justify-end">
                        <button type="submit" class="px-12 py-5 bg-slate-900 dark:bg-indigo-600 text-white font-black rounded-2xl text-sm shadow-2xl hover:opacity-90 transition transform active:scale-95 uppercase tracking-[0.2em]">
                            💾 {{ app()->getLocale() == 'km' ? 'រក្សាទុកការកំណត់សិទ្ធិ' : 'Save Matrix Settings' }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- ៣. បញ្ជីសមាជិក (User List - អក្សរធំច្បាស់ល្អ) -->
            <div class="bg-white/60 dark:bg-slate-900/40 backdrop-blur-xl rounded-[2.5rem] border border-slate-200 dark:border-slate-800/60 shadow-2xl p-8 transition-all duration-300">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white flex items-center">
                        <span class="p-2.5 bg-blue-500/10 rounded-xl mr-4">👥</span> 
                        {{ app()->getLocale() == 'km' ? 'បញ្ជីគណនីសមាជិកទាំងអស់' : 'All Member Accounts' }}
                    </h3>
                    <div class="text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] bg-slate-100 dark:bg-slate-800/50 px-5 py-2.5 rounded-2xl border border-slate-200/50 dark:border-slate-700/50">
                        Total System Users: {{ count($users) }}
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 dark:border-slate-800/60">
                                <th class="pb-6 px-4">{{ app()->getLocale() == 'km' ? 'ព័ត៌មានសមាជិក' : 'Identity' }}</th>
                                <th class="pb-6 px-4 text-center">{{ app()->getLocale() == 'km' ? 'សិទ្ធិប្រើប្រាស់' : 'Access Level' }}</th>
                                <th class="pb-6 px-4 text-right">{{ app()->getLocale() == 'km' ? 'សកម្មភាព' : 'Actions' }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium">
                            @foreach($users as $user)
                                <tr class="group hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition duration-150">
                                    <td class="py-6 px-4">
                                        <div class="flex items-center space-x-5">
                                            <div class="relative">
                                                @if($user->avatar)
                                                    <img src="{{ asset($user->avatar) }}" class="w-16 h-16 rounded-[1.2rem] object-cover border-2 border-white dark:border-slate-700 shadow-md transition-transform group-hover:scale-105">
                                                @else
                                                    <div class="w-16 h-16 rounded-[1.2rem] bg-gradient-to-tr from-blue-500 to-indigo-600 text-white flex items-center justify-center font-black text-2xl border-2 border-white dark:border-slate-700 shadow-md">
                                                        {{ Str::limit($user->name, 1, '') }}
                                                    </div>
                                                @endif
                                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 border-[3px] border-white dark:border-slate-900 rounded-full shadow-sm"></div>
                                            </div>
                                            <div>
                                                <div class="font-black text-lg text-slate-800 dark:text-white leading-none">{{ $user->name }}</div>
                                                <div class="text-sm font-bold text-slate-400 mt-2">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-6 px-4 text-center">
                                        @php
                                            $roleStyles = [
                                                'admin'   => 'bg-slate-900 text-white dark:bg-white dark:text-slate-900 shadow-lg',
                                                'owner'   => 'bg-slate-900 text-white dark:bg-white dark:text-slate-900 shadow-lg',
                                                'manager' => 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20',
                                                'staff'   => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20',
                                                'student' => 'bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400 border border-slate-200 dark:border-slate-700',
                                            ];
                                        @endphp
                                        <span class="px-5 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest {{ $roleStyles[$user->role] ?? $roleStyles['student'] }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="py-6 px-4">
                                        <div class="flex justify-end space-x-4">
                                            <a href="{{ route('users.edit', $user->id) }}" class="p-3.5 bg-blue-500/10 text-blue-500 hover:bg-blue-600 hover:text-white rounded-2xl transition duration-200 shadow-sm border border-blue-500/10">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('តើលោកអ្នកប្រាកដជាចង់លុបគណនីនេះមែនទេ?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-3.5 bg-rose-500/10 text-rose-500 hover:bg-rose-600 hover:text-white rounded-2xl transition duration-200 shadow-sm border border-rose-500/10">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>