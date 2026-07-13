<nav x-data="{ open: false, darkMode: localStorage.getItem('darkMode') !== 'false' }" 
     x-bind:class="darkMode ? 'bg-slate-900/90 border-slate-800 text-white shadow-lg' : 'bg-white/90 border-slate-100 text-slate-800 shadow-sm'"
     class="border-b transition-colors duration-150 sticky top-0 z-50 backdrop-blur-md font-sans">
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- ផ្នែកខាងឆ្វេង៖ Logo និងឈ្មោះក្រុមហ៊ុន -->
            <div class="flex items-center h-full">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-5 group transition transform hover:scale-[1.02] duration-150">
                        <div class="relative">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full blur opacity-30 group-hover:opacity-70 transition duration-150"></div>
                            <img class="relative h-11 w-11 rounded-full object-cover border-2 border-white dark:border-slate-800 shadow-md" src="{{ asset('images/logo.png') }}" alt="Logo">
                        </div>
                        <span class="text-2xl font-extrabold tracking-widest bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 bg-clip-text text-transparent group-hover:from-blue-400 group-hover:to-purple-500 transition duration-150">
                            PHIROM MANAGER
                        </span>
                    </a>
                </div>
            </div>

            <!-- ផ្នែកខាងស្ដាំ៖ Settings & Language Switcher Dropdown (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                
                <!-- ១. ប៊ូតុងកុងតាក់ប្ដូរពន្លឺ ល្បឿនលឿនបំផុត (Ultra-Fast Toggle) -->
                <button @click="
                            darkMode = !darkMode; 
                            localStorage.setItem('darkMode', darkMode);
                            if (darkMode) {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        " 
                        x-bind:class="darkMode ? 'bg-slate-800 border-slate-700 text-amber-400 hover:bg-slate-750' : 'bg-slate-100 border-slate-200 text-slate-500 hover:bg-slate-200'"
                        class="p-2.5 rounded-xl border transition-all duration-150 focus:outline-none shadow-inner flex items-center justify-center">
                    
                    <!-- Sun Icon (បង្ហាញពេល Dark Mode) -->
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                    <!-- Moon Icon (បង្ហាញពេល Light Mode) -->
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>

                <!-- ២. ប៊ូតុងប្ដូរភាសាស្ទីលគ្រាប់ថ្នាំ Premium Capsule -->
                <div x-bind:class="darkMode ? 'bg-slate-800/50 border-slate-700' : 'bg-slate-100 border-slate-200'"
                     class="flex p-1 rounded-xl border backdrop-blur-sm transition-colors duration-150">
                    <a href="{{ route('lang.switch', 'km') }}" 
                       class="px-3.5 py-1.5 text-xs font-bold rounded-lg transition-all duration-150 {{ app()->getLocale() == 'km' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-300' }}">
                        ខ្មែរ
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}" 
                       class="px-3.5 py-1.5 text-xs font-bold rounded-lg transition-all duration-150 {{ app()->getLocale() == 'en' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md' : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-300' }}">
                        EN
                    </a>
                </div>

                <!-- ៣. Profile Dropdown -->
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button x-bind:class="darkMode ? 'bg-slate-800/40 border-slate-700 text-slate-200 hover:bg-slate-800' : 'bg-slate-50 border-slate-200 text-slate-700 hover:bg-slate-100'"
                                class="inline-flex items-center pl-2 pr-3.5 py-1.5 border rounded-xl text-sm font-bold focus:outline-none transition-all duration-150">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset(Auth::user()->avatar) }}" class="h-8 w-8 rounded-full object-cover border border-white dark:border-slate-700 shadow-sm" alt="Profile">
                            @else
                                <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold uppercase shadow-sm">
                                    {{ Str::limit(Auth::user()->name, 1, '') }}
                                </div>
                            @endif
                            <div class="ms-2.5 tracking-wide text-xs max-w-[100px] truncate">{{ Auth::user()->name }}</div>
                            <svg class="ms-1.5 h-4 w-4 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- ប៊ូតុងកែសម្រួលរូបភាពប្រវត្តិរូបពី PC (ផ្ទាល់) -->
                        <button type="button" onclick="document.getElementById('nav-avatar-file-input').click()" class="flex items-center w-full text-left px-4 py-2.5 text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition duration-150 border-b border-slate-100 dark:border-slate-800">
                            <svg class="w-4 h-4 me-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V3z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ __('Change Photo') }}
                        </button>

                        <x-dropdown-link :href="route('profile.edit')" class="text-xs font-bold flex items-center">
                            <svg class="w-4 h-4 me-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="text-xs font-bold text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/30 flex items-center" onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="w-4 h-4 me-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile Toggle) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition duration-150 focus:outline-none border border-transparent dark:border-slate-800 shadow-sm">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 transition-all duration-150" x-cloak>
        <div class="pt-2 pb-3 space-y-1 px-4">
            @php
                $navLinks = [
                    'view_dashboard' => ['dashboard', __('messages.dashboard')],
                    'manage_lessons' => ['lessons.index', 'គ្រប់គ្រងមេរៀន'],
                    'manage_school' => ['students.index', 'គ្រប់គ្រងសាលារៀន'],
                    'manage_products' => ['products.index', 'ឃ្លាំងកុំព្យូទ័រ'],
                    'manage_beverages' => ['beverages.index', 'ហាងកាហ្វេ'],
                ];
            @endphp
            @foreach($navLinks as $perm => $data)
                @if(auth()->user()->canPerform($perm))
                    <x-responsive-nav-link :href="route($data[0])" :active="request()->routeIs($data[0])" class="rounded-xl font-bold dark:text-slate-200">
                        {{ $data[1] }}
                    </x-responsive-nav-link>
                @endif
            @endforeach
            
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'owner')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" class="rounded-xl font-bold dark:text-slate-200">
                    {{ __('messages.user_manager') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-4 border-t border-slate-100 dark:border-slate-800 px-6 bg-slate-50/50 dark:bg-slate-950/20">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3.5">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset(Auth::user()->avatar) }}" class="h-10 w-10 rounded-full object-cover border border-slate-200 shadow-sm" alt="Profile">
                    @else
                        <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold uppercase">
                            {{ Str::limit(Auth::user()->name, 1, '') }}
                        </div>
                    @endif
                    <div>
                        <div class="font-extrabold text-sm text-slate-800 dark:text-white">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-slate-500 font-medium">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="flex p-1 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 items-center">
                    <a href="{{ route('lang.switch', 'km') }}" class="px-2.5 py-1 text-[10px] font-bold rounded-lg transition {{ app()->getLocale() == 'km' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-400' }}">ខ្មែរ</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="px-2.5 py-1 text-[10px] font-bold rounded-lg transition {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-400' }}">EN</a>
                </div>
            </div>

            <div class="mt-4 space-y-1">
                <button type="button" onclick="document.getElementById('nav-avatar-file-input').click()" class="flex items-center w-full px-4 py-2.5 text-xs font-bold text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition">
                    <svg class="w-4 h-4 me-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V3z"></path></svg>
                    {{ __('Change Photo') }}
                </button>
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl font-bold dark:text-slate-200">
                    <svg class="w-4 h-4 me-3 text-indigo-500 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="rounded-xl font-bold text-rose-600 dark:text-rose-400" onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg class="w-4 h-4 me-3 text-rose-500 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    <!-- Hidden Avatar Upload Form (No Modal Needed, Instant Upload) -->
    <form id="nav-avatar-upload-form" method="POST" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data" class="hidden">
        @csrf
        <input type="file" id="nav-avatar-file-input" name="avatar" onchange="document.getElementById('nav-avatar-upload-form').submit()" accept="image/*">
    </form>
</nav>