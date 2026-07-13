<x-app-layout>
    <div class="py-12 relative z-10 font-sans transition-all duration-500">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12 relative">

            <!-- ១. បដារំកិលអូតូ (Premium Auto-Play Carousel Banner) -->
            <div x-data="{ 
                    activeSlide: 1, 
                    slidesCount: 3,
                    next() { this.activeSlide = this.activeSlide === this.slidesCount ? 1 : this.activeSlide + 1 },
                    prev() { this.activeSlide = this.activeSlide === 1 ? this.slidesCount : this.activeSlide - 1 }
                 }"
                 x-init="setInterval(() => next(), 7000)" 
                 class="relative rounded-[2.5rem] overflow-hidden shadow-2xl h-80 sm:h-[480px] border border-white/20 dark:border-slate-800/50 group transition-all duration-500">
                 
                 <!-- Slide 1: PHIROM COMPUTER -->
                 <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-0">
                     <img src="https://images.unsplash.com/photo-1547082299-de196ea013d6?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover" alt="Computers">
                     <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
                     <div class="absolute inset-x-0 bottom-0 p-8 sm:p-12 flex flex-col justify-end h-full space-y-4">
                         <span class="px-4 py-1.5 rounded-full text-xs font-black bg-blue-600/30 text-blue-200 border border-blue-400/30 uppercase tracking-[0.2em] self-start">PHIROM COMPUTER</span>
                         <h1 class="text-3xl sm:text-5xl font-black text-white leading-tight tracking-tight">{{ __('messages.slide_pc_title') }}</h1>
                         <p class="text-gray-300 text-sm sm:text-lg leading-relaxed max-w-2xl font-medium">{{ __('messages.slide_pc_desc') }}</p>
                     </div>
                 </div>

                 <!-- Slide 2: PHIROM CAFE -->
                 <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-0" x-cloak>
                     <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover" alt="Cafe">
                     <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
                     <div class="absolute inset-x-0 bottom-0 p-8 sm:p-12 flex flex-col justify-end h-full space-y-4">
                         <span class="px-4 py-1.5 rounded-full text-xs font-black bg-amber-600/30 text-amber-200 border border-amber-400/30 uppercase tracking-[0.2em] self-start">PHIROM CAFE</span>
                         <h1 class="text-3xl sm:text-5xl font-black text-white leading-tight tracking-tight">{{ __('messages.slide_cafe_title') }}</h1>
                         <p class="text-gray-300 text-sm sm:text-lg leading-relaxed max-w-2xl font-medium">{{ __('messages.slide_cafe_desc') }}</p>
                     </div>
                 </div>

                 <!-- Slide 3: PHIROM SCHOOL -->
                 <div x-show="activeSlide === 3" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-0" x-cloak>
                     <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover" alt="School">
                     <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
                     <div class="absolute inset-x-0 bottom-0 p-8 sm:p-12 flex flex-col justify-end h-full space-y-4">
                         <span class="px-4 py-1.5 rounded-full text-xs font-black bg-emerald-600/30 text-emerald-200 border border-emerald-400/30 uppercase tracking-[0.2em] self-start">PHIROM SCHOOL</span>
                         <h1 class="text-3xl sm:text-5xl font-black text-white leading-tight tracking-tight">{{ __('messages.slide_school_title') }}</h1>
                         <p class="text-gray-300 text-sm sm:text-lg leading-relaxed max-w-2xl font-medium">{{ __('messages.slide_school_desc') }}</p>
                     </div>
                 </div>

                 <!-- Navigation Arrows -->
                 <button @click="prev()" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white p-4 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 z-20 border border-white/10 focus:outline-none">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                 </button>
                 <button @click="next()" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white p-4 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 z-20 border border-white/10 focus:outline-none">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                 </button>

                 <!-- Indicators -->
                 <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3 z-20">
                     <template x-for="i in slidesCount" :key="i">
                         <button @click="activeSlide = i" 
                                 :class="activeSlide === i ? 'w-10 bg-white shadow-[0_0_10px_rgba(255,255,255,0.8)]' : 'w-2.5 bg-white/40'" 
                                 class="h-2.5 rounded-full transition-all duration-500 focus:outline-none"></button>
                     </template>
                 </div>
            </div>

            <!-- ២. ផ្ទាំង Workspace Grid (Premium Visualization) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $workspaces = [
                        ['perm' => 'manage_products', 'route' => 'workspace.computers', 'title' => __('messages.workspace_computers'), 'img' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?auto=format&fit=crop&w=400&q=80', 'color' => 'blue'],
                        ['perm' => 'manage_school', 'route' => 'workspace.school', 'title' => __('messages.workspace_school'), 'img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=400&q=80', 'color' => 'emerald'],
                        ['perm' => 'manage_beverages', 'route' => 'workspace.cafe', 'title' => __('messages.workspace_cafe'), 'img' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=400&q=80', 'color' => 'amber'],
                        ['perm' => 'manage_lessons', 'route' => 'workspace.library', 'title' => __('messages.workspace_library'), 'img' => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=400&q=80', 'color' => 'purple'],
                    ];
                @endphp

                @foreach($workspaces as $ws)
                    @if(auth()->user()->canPerform($ws['perm']))
                        <div class="relative h-[440px] rounded-[2.5rem] overflow-hidden shadow-xl border border-transparent hover:border-{{ $ws['color'] }}-500/50 hover:-translate-y-3 transition-all duration-500 group">
                            <img src="{{ $ws['img'] }}" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="Workspace">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                            <div class="absolute inset-x-0 bottom-0 p-8 flex flex-col justify-end h-full space-y-4">
                                <h3 class="text-2xl font-black text-white tracking-wide">{{ $ws['title'] }}</h3>
                                <a href="{{ route($ws['route']) }}" class="w-full py-4 bg-{{ $ws['color'] }}-600 hover:bg-{{ $ws['color'] }}-700 text-white font-bold rounded-2xl text-sm text-center transition-all shadow-lg active:scale-95">
                                    {{ __('messages.enter_workspace') }} &rarr;
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- ៣. ផ្ទាំងសកម្មភាពរហ័ស (⚡ Quick Actions) -->
            <div class="bg-white/60 dark:bg-slate-900/40 backdrop-blur-xl rounded-[2.5rem] p-10 border border-slate-200 dark:border-slate-800/60 shadow-xl space-y-8">
                <h3 class="text-2xl font-black tracking-tight flex items-center space-x-4">
                    <span class="p-2 bg-indigo-500/10 rounded-xl">⚡</span>
                    <span>{{ __('messages.quick_actions') }}</span>
                </h3>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $actions = [
                            'manage_school' => ['students.create', 'emerald', 'quick_add_student'],
                            'manage_products' => ['products.create', 'blue', 'quick_add_product'],
                            'manage_beverages' => ['beverages.create', 'amber', 'quick_add_beverage'],
                            'manage_lessons' => ['lessons.create', 'purple', 'quick_upload_lesson']
                        ];
                    @endphp
                    @foreach($actions as $perm => $data)
                        @if(auth()->user()->canPerform($perm))
                            <a href="{{ route($data[0]) }}" class="group flex flex-col items-center p-6 rounded-3xl bg-{{ $data[1] }}-500/5 border border-{{ $data[1] }}-500/10 hover:border-{{ $data[1] }}-500/40 hover:bg-{{ $data[1] }}-500/10 transition-all duration-300">
                                <span class="text-xs font-black text-{{ $data[1] }}-600 dark:text-{{ $data[1] }}-400 uppercase tracking-widest text-center">{{ __('messages.' . $data[2]) }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- ៤. ផ្នែកព័ត៌មានក្រុមហ៊ុន (Enterprise Info) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-10">
                <div class="bg-white/40 dark:bg-slate-900/30 backdrop-blur-md rounded-[2.5rem] p-8 border border-slate-200 dark:border-slate-800 shadow-sm transition duration-300">
                    <h4 class="text-xl font-black mb-4 flex items-center space-x-3">
                        <span class="text-2xl">🏢</span>
                        <span>{{ __('messages.about_us') }}</span>
                    </h4>
                    <p class="text-sm font-medium leading-relaxed text-slate-600 dark:text-slate-400">
                        {{ __('messages.about_us_desc') }}
                    </p>
                </div>

                <div class="bg-white/40 dark:bg-slate-900/30 backdrop-blur-md rounded-[2.5rem] p-8 border border-slate-200 dark:border-slate-800 shadow-sm transition duration-300">
                    <h4 class="text-xl font-black mb-4 flex items-center space-x-3">
                        <span class="text-2xl">📊</span>
                        <span>{{ __('messages.access_structure') }}</span>
                    </h4>
                    <ul class="text-sm font-bold space-y-3">
                        <li class="flex items-center text-indigo-500"><span class="w-2.5 h-2.5 rounded-full bg-indigo-500 mr-3"></span>Owner / Admin</li>
                        <li class="flex items-center text-blue-500"><span class="w-2.5 h-2.5 rounded-full bg-blue-500 mr-3"></span>Manager</li>
                        <li class="flex items-center text-emerald-500"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500 mr-3"></span>Staff</li>
                    </ul>
                </div>

                <div class="bg-white/40 dark:bg-slate-900/30 backdrop-blur-md rounded-[2.5rem] p-8 border border-slate-200 dark:border-slate-800 shadow-sm transition duration-300">
                    <h4 class="text-xl font-black mb-4 flex items-center space-x-3">
                        <span class="text-2xl">📞</span>
                        <span>{{ __('messages.contact_support') }}</span>
                    </h4>
                    <div class="text-sm font-bold space-y-3 text-slate-600 dark:text-slate-400">
                        <p class="flex items-center"><span class="mr-3 text-blue-500">📍</span>{{ __('messages.address_detail') }}</p>
                        <p class="flex items-center"><span class="mr-3 text-emerald-500">📞</span>{{ __('messages.phone_detail') }}</p>
                        <p class="flex items-center"><span class="mr-3 text-purple-500">📧</span>{{ __('messages.email_detail') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>