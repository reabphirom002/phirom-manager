<x-app-layout>
    <!-- ស្រូបយកតម្លៃ darkMode សកលពី app.blade.php មេ ធ្វើឱ្យទំព័រទាំងមូលស៊ីសង្វាក់គ្នាគ្មានភាពឆ្គង -->
    <div class="py-12 transition-colors duration-300 relative overflow-hidden min-h-screen">
        
        <!-- ពន្លឺ Mesh Gradient ប្រែប្រួលទៅតាម Dark/Light Mode ដូចទំព័រ Welcome -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full blur-3xl -z-10 transition duration-300 bg-purple-500/5 dark:bg-purple-600/10"></div>
        <div class="absolute top-1/3 left-1/3 w-[300px] h-[300px] rounded-full blur-3xl -z-10 transition duration-300 bg-violet-500/5 dark:bg-violet-600/10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10 relative z-10 font-sans">

            <!-- ១. បដាក្បាលទំព័រ និងប៊ូតុងសកម្មភាព (Header Section) -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-6 border-b pb-6 transition duration-350 border-gray-200 dark:border-slate-800">
                <div class="text-center sm:text-left">
                    <span class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full border inline-block shadow-sm bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 border-purple-100 dark:border-purple-500/20">PHIROM LIBRARY WORKSPACE</span>
                    <h1 class="text-2xl sm:text-3xl font-bold mt-3 text-gray-900 dark:text-white">{{ __('messages.workspace_library') }}</h1>
                </div>
                
                <!-- ស្ពានសកម្មភាពចាត់ចែង -->
                <div class="flex items-center space-x-3">
                    <!-- ប៊ូតុងទៅកាន់ទំព័របញ្ជីឯកសាររួម (http://127.0.0.1:8000/lessons) -->
                    <a href="{{ route('lessons.index') }}" x-bind:class="darkMode ? 'bg-slate-800 border-slate-700 text-slate-300 hover:text-white' : 'bg-white border-gray-200 text-gray-600 hover:text-gray-900'" class="px-5 py-3 border text-sm font-bold rounded-xl transition shadow-sm">
                        📄 {{ __('messages.all_lessons') }}
                    </a>

                    <!-- ប៊ូតុងបន្ថែមមេរៀនថ្មី -->
                    <a href="{{ route('lessons.create') }}" class="px-5 py-3 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl text-sm shadow transition duration-150">
                        + {{ __('messages.add_lesson') }}
                    </a>
                </div>
            </div>

            <!-- ២. រូបភាពបដាធំរបស់បណ្ណាល័យ (Featured Library Banner - Unsplash High-Resolution) -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl h-80 sm:h-96 border-2 border-purple-500/10 hover:border-purple-500/30 transition duration-300">
                <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1200&q=80" 
                     class="w-full h-full object-cover transform scale-105 hover:scale-100 transition duration-700" 
                     alt="PHIROM Library Setup">
                
                <!-- ម៉ាស់ខ្មៅគ្របពីលើរូបភាព និងបង្ហាញព័ត៌មានលម្អិតបែបកម្រិតខ្ពស់ (Glassmorphism Overlay) -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent flex flex-col justify-end p-6 sm:p-8">
                    <div class="max-w-2xl space-y-4 text-left">
                        <h2 class="text-xl sm:text-3xl font-bold text-white tracking-wide">{{ __('messages.slide_school_title') }}</h2>
                        <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                            {{ __('messages.slide_school_desc') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- ៣. ប្រអប់របាយការណ៍សង្ខេបប្រណិត (Overview Cards) -->
            <div class="bg-white p-6 rounded-3xl border transition duration-300" :class="darkMode ? 'bg-slate-900/60 border-slate-800' : 'bg-white border-gray-200 shadow-sm'">
                <span class="text-slate-400 text-xs font-bold uppercase">{{ __('messages.total_documents') }}</span>
                <div class="text-3xl font-black text-purple-500 mt-2">{{ $totalLessons }} {{ app()->getLocale() == 'km' ? 'ឯកសារ' : 'Files' }}</div>
            </div>

            <!-- ៤. ផ្នែកបង្ហាញកាតមេរៀនជាលក្ខណៈ Thumbnail រូបភាពពិតៗ (Lessons Thumbnail Cards Grid) -->
            <div class="space-y-6">
                <h3 class="text-lg font-bold" :class="darkMode ? 'text-white' : 'text-gray-900'">📄 {{ __('messages.all_lessons') }}</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($lessons as $l)
                        <!-- ជម្រះកូដ HTML ស្មុគស្មាញចោល ដើម្បីសល់តែអត្ថបទអក្សរស្អាតច្បាស់លាស់ -->
                        @php
                            $cleanDescription = strip_tags($l->description ?? 'គ្មានការពិពណ៌នាលម្អិតនៃឯកសារនេះឡើយបាទ');
                        @endphp

                        <div :class="darkMode ? 'bg-slate-900/60 border-slate-800 hover:border-purple-500/40' : 'bg-white border-gray-200 hover:border-purple-500/40 hover:shadow-lg'"
                             class="rounded-3xl border overflow-hidden transition duration-300 flex flex-col justify-between">
                            
                            <div>
                                <!-- រូបភាពក្របមេរៀន / Thumbnail -->
                                <div class="h-44 bg-purple-500/10 flex items-center justify-center relative overflow-hidden">
                                    @if ($l->thumbnail)
                                        <img src="{{ str_contains($l->thumbnail, 'http') ? $l->thumbnail : asset('storage/' . $l->thumbnail) }}" class="h-full w-full object-cover" alt="{{ $l->title }}">
                                    @else
                                        <span class="text-5xl">📄</span>
                                    @endif
                                    <span class="absolute top-4 left-4 px-2.5 py-0.5 bg-purple-500/20 text-purple-400 border border-purple-500/30 rounded-md text-[10px] font-bold uppercase tracking-wider">{{ $l->type }}</span>
                                </div>

                                <!-- ព័ត៌មានលម្អិតរបស់មេរៀន (ជាមួយមុខងារអានបន្ថែម/បង្រួមដ៏រស់រវើក) -->
                                <div class="p-6 space-y-4 text-left">
                                    <h3 :class="darkMode ? 'text-white' : 'text-gray-900'" class="font-bold text-base leading-snug tracking-wide transition duration-300">{{ $l->title }}</h3>
                                    
                                    <!-- ប្រព័ន្ធប្ដូរអត្ថបទខ្លីវែងស្វ័យប្រវត្ត (Show More/Less) -->
                                    <div x-data="{ expanded: false, desc: '{{ e($cleanDescription) }}' }" class="space-y-1">
                                        <p class="text-slate-400 text-xs leading-relaxed" 
                                           x-text="expanded ? desc : desc.substring(0, 100) + (desc.length > 100 ? '...' : '')">
                                        </p>
                                        <template x-if="desc.length > 100">
                                            <button @click="expanded = !expanded" 
                                                    class="text-purple-400 hover:text-purple-300 text-[10px] font-bold uppercase focus:outline-none transition mt-1.5 block">
                                                <span x-text="expanded ? 'បង្រួម (Show Less)' : 'អានបន្ថែម (Show More)'"></span>
                                            </button>
                                        </template>
                                    </div>

                                    <span class="inline-block mt-2 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                        {{ $l->category->name ?? (app()->getLocale() == 'km' ? 'បណ្ណាល័យ' : 'Library') }}
                                    </span>
                                </div>
                            </div>

                            <!-- ផ្នែកគ្រប់គ្រងនៅលើកាត (Actions) -->
                            <div :class="darkMode ? 'border-slate-800/60' : 'border-gray-100'" class="p-6 pt-0 border-t mt-4 space-y-4">
                                <div class="flex justify-between items-center pt-4">
                                    <span class="text-xs text-slate-400">{{ app()->getLocale() == 'km' ? 'កាលបរិច្ឆេទ៖' : 'Date:' }} {{ $l->created_at ? $l->created_at->format('Y-m-d') : 'ทើបតែបញ្ចូល' }}</span>
                                    <span class="text-xs font-bold text-purple-400 bg-purple-500/10 border border-purple-500/20 px-2.5 py-1 rounded-full">{{ app()->getLocale() == 'km' ? 'ឯកសារសិក្សា' : 'Study Resource' }} 📄</span>
                                </div>

                                <!-- ប៊ូតុង កែប្រែ / លុប -->
                                <div class="flex space-x-2 pt-2">
                                    <a href="{{ route('lessons.edit', $l->id) }}" class="w-1/2 text-center py-2.5 bg-gray-500/10 hover:bg-gray-500/20 text-gray-400 hover:text-white rounded-xl text-xs font-bold transition">
                                        {{ __('messages.edit') }}
                                    </a>
                                    <form action="{{ route('lessons.destroy', $l->id) }}" method="POST" class="w-1/2" onsubmit="return confirm('{{ __('messages.sure_to_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full py-2.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 hover:text-red-500 rounded-xl text-xs font-bold transition">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    @empty
                        <!-- ករណីគ្មានទិន្នន័យ -->
                        <div :class="darkMode ? 'bg-slate-900/20 border-slate-800' : 'bg-gray-100 border-gray-200'"
                             class="col-span-full py-16 text-center text-slate-500 border rounded-3xl">
                            <span class="text-5xl block mb-3">📄</span>
                            <p class="text-sm font-semibold">{{ __('messages.no_lessons') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>