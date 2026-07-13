<x-app-layout>
    <!-- ស្រូបយកតម្លៃ darkMode សកលពី app.blade.php មេ ធ្វើឱ្យទំព័រទាំងមូលស៊ីសង្វាក់គ្នាគ្មានភាពឆ្គង -->
    <div class="py-12 transition-colors duration-300 relative overflow-hidden min-h-screen">
        
        <!-- ពន្លឺ Mesh Gradient ប្រែប្រួលទៅតាម Dark/Light Mode ដូចទំព័រ Welcome -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full blur-3xl -z-10 transition duration-300 bg-emerald-500/5 dark:bg-emerald-600/10"></div>
        <div class="absolute top-1/3 left-1/3 w-[300px] h-[300px] rounded-full blur-3xl -z-10 transition duration-300 bg-teal-500/5 dark:bg-teal-600/10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10 relative z-10 font-sans">

            <!-- ១. បដាក្បាលទំព័រ និងប៊ូតុងសកម្មភាព (Header Section) -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-6 border-b pb-6 transition duration-350 border-gray-200 dark:border-slate-800">
                <div class="text-center sm:text-left">
                    <span class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full border inline-block shadow-sm bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-100 dark:border-emerald-500/20">PHIROM SCHOOL WORKSPACE</span>
                    <h1 class="text-2xl sm:text-3xl font-bold mt-3 text-gray-900 dark:text-white">{{ __('messages.workspace_school') }}</h1>
                </div>
                
                <!-- ប៊ូតុងសកម្មភាពចាត់ចែង -->
                <div class="flex items-center space-x-3">
                    <!-- ប៊ូតុងទៅកាន់ទំព័របញ្ជីសិស្សរួម (http://127.0.0.1:8000/students) -->
                    <a href="{{ route('students.index') }}" x-bind:class="darkMode ? 'bg-slate-800 border-slate-700 text-slate-300 hover:text-white' : 'bg-white border-gray-200 text-gray-600 hover:text-gray-900'" class="px-5 py-3 border text-sm font-bold rounded-xl transition shadow-sm">
                        👨‍🎓 {{ __('messages.students') }}
                    </a>

                    <!-- ប៊ូតុងបង្កើតថ្នាក់រៀនថ្មី -->
                    <a href="{{ route('students.create') }}" class="px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm shadow transition duration-150">
                        + {{ __('messages.add_student') }}
                    </a>
                </div>
            </div>

            <!-- ២. រូបភាពបដាធំរបស់ក្រុមសាលារៀន (Featured PC School Banner - Unsplash High-Resolution) -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl h-80 sm:h-96 border-2 border-emerald-500/10 hover:border-emerald-500/30 transition duration-300">
                <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80" 
                     class="w-full h-full object-cover transform scale-105 hover:scale-100 transition duration-700" 
                     alt="PHIROM Computer School">
                
                <!-- ម៉ាស់ខ្មៅគ្របពីលើរូបភាព និងបង្ហាញព័ត៌មានលម្អិតបែបកម្រិតខ្ពស់ (Glassmorphism Overlay) -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent flex flex-col justify-end p-6 sm:p-8">
                    <div class="max-w-2xl space-y-3 text-left">
                        <h2 class="text-xl sm:text-3xl font-bold text-white tracking-wide">{{ __('messages.slide_school_title') }}</h2>
                        <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                            {{ __('messages.slide_school_desc') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- ៣. ប្រអប់របាយការណ៍សង្ខេបប្រណិត (Overview Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div :class="darkMode ? 'bg-slate-900/60 border-slate-800' : 'bg-white border-gray-200 shadow-sm'" class="p-6 rounded-3xl border transition duration-300">
                    <span class="text-slate-400 text-xs font-bold uppercase">{{ __('messages.manage_classrooms') }}</span>
                    <div class="text-3xl font-black text-emerald-500 mt-2">{{ $totalClasses }} {{ app()->getLocale() == 'km' ? 'ថ្នាក់' : 'Classes' }}</div>
                </div>
                <div :class="darkMode ? 'bg-slate-900/60 border-slate-800' : 'bg-white border-gray-200 shadow-sm'" class="p-6 rounded-3xl border transition duration-300">
                    <span class="text-slate-400 text-xs font-bold uppercase">{{ app()->getLocale() == 'km' ? 'ថ្នាក់រៀនសកម្ម' : 'Active Classrooms' }}</span>
                    <div class="text-3xl font-black text-blue-500 mt-2">{{ $activeClasses }} {{ app()->getLocale() == 'km' ? 'ថ្នាក់' : 'Classes' }}</div>
                </div>
            </div>

            <!-- ៤. ផ្នែកបង្ហាញកាតថ្នាក់រៀនជាលក្ខណៈ Thumbnail រូបភាពកុំព្យូទ័រស្អាតៗ (Class Thumbnail Cards Grid) -->
            <div class="space-y-6">
                <h3 class="text-lg font-bold" :class="darkMode ? 'text-white' : 'text-gray-900'">🏫 {{ app()->getLocale() == 'km' ? 'ថ្នាក់រៀនកំពុងដំណើរការសកម្ម' : 'Active Classrooms List' }}</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($classrooms as $index => $c)
                        <div :class="darkMode ? 'bg-slate-900/60 border-slate-800 hover:border-emerald-500/40' : 'bg-white border-gray-200 hover:border-emerald-500/40 hover:shadow-lg'"
                             class="rounded-3xl border overflow-hidden transition duration-300 flex flex-col justify-between">
                            
                            <div>
                                <!-- រូបថតកុំព្យូទ័រ និងការសរសេរកូដពិតៗ (ស្អាត និងច្បាស់ល្អ ១០០%) -->
                                <div class="h-44 bg-emerald-500/10 relative overflow-hidden">
                                    @if($index % 3 === 0)
                                        <img src="https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover" alt="Coding Class">
                                    @elseif($index % 3 === 1)
                                        <img src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover" alt="UI UX Design Class">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover" alt="Web Dev Class">
                                    @endif
                                    <span class="absolute top-4 left-4 px-2.5 py-0.5 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-md text-[10px] font-bold uppercase tracking-wider">ACTIVE CLASS</span>
                                </div>

                                <!-- ព័ត៌មានលម្អិតរបស់ថ្នាក់រៀន -->
                                <div class="p-6 space-y-3 text-left">
                                    <h4 :class="darkMode ? 'text-white' : 'text-gray-900'" class="font-bold text-base transition">{{ $c->name }}</h4>
                                    <p class="text-slate-400 text-xs flex items-center">
                                        <span class="mr-1.5">👨‍🏫 {{ __('messages.teacher_name') }}៖</span>
                                        <span class="font-bold text-gray-300" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">{{ $c->teacher_name }}</span>
                                    </p>
                                    <p class="text-slate-400 text-xs flex items-center">
                                        <span class="mr-1.5">📚 {{ __('messages.course_name') }}៖</span>
                                        <span class="font-bold text-indigo-400">{{ $c->course->name ?? 'វគ្គសិក្សាទូទៅ' }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- ម៉ោងសិក្សានៅផ្នែកខាងក្រោម -->
                            <div :class="darkMode ? 'border-slate-800/60' : 'border-gray-150'" class="p-6 pt-0 border-t mt-4 flex justify-between items-center">
                                <span class="text-xs text-slate-400">{{ $c->days }}</span>
                                <span class="text-xs font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-1 rounded-full">{{ $c->time_slot }}</span>
                            </div>

                        </div>
                    @empty
                        <!-- ករណីគ្មានថ្នាក់រៀនសកម្ម -->
                        <div :class="darkMode ? 'bg-slate-900/20 border-slate-800' : 'bg-gray-100 border-gray-200'"
                             class="col-span-full py-16 text-center text-slate-500 border rounded-3xl">
                            <span class="text-5xl block mb-3">🏫</span>
                            <p class="text-sm font-semibold">{{ __('messages.sure_to_delete_classroom') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>