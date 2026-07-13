<x-app-layout>
    <!-- ស្រូបយកតម្លៃ darkMode សកលពី app.blade.php មេ ធ្វើឱ្យទំព័រទាំងមូលស៊ីសង្វាក់គ្នាគ្មានភាពឆ្គង -->
    <div class="py-12 transition-colors duration-300 relative overflow-hidden min-h-screen">
        
        <!-- ពន្លឺ Mesh Gradient ប្រែប្រួលទៅតាម Dark/Light Mode ដូចទំព័រ Welcome -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full blur-3xl -z-10 transition duration-300 bg-blue-500/5 dark:bg-blue-600/10"></div>
        <div class="absolute top-1/3 left-1/3 w-[300px] h-[300px] rounded-full blur-3xl -z-10 transition duration-300 bg-indigo-500/5 dark:bg-indigo-600/10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10 relative z-10 font-sans">

            <!-- ១. បដាក្បាលទំព័រ និងប៊ូតុងសកម្មភាព (Header Section) -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-6 border-b pb-6 transition duration-350 border-gray-200 dark:border-slate-800">
                <div class="text-center sm:text-left">
                    <span class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full border inline-block shadow-sm bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-100 dark:border-blue-500/20">PHIROM COMPUTER WORKSPACE</span>
                    <h1 class="text-2xl sm:text-3xl font-bold mt-3 text-gray-900 dark:text-white">{{ __('messages.workspace_computers') }}</h1>
                </div>
                
                <!-- ប៊ូតុងសកម្មភាពចាត់ចែង -->
                <div class="flex items-center space-x-3">
                    <!-- ប៊ូតុងទៅកាន់ទំព័របញ្ជីទំនិញរួម (http://127.0.0.1:8000/products) -->
                    <a href="{{ route('products.index') }}" x-bind:class="darkMode ? 'bg-slate-800 border-slate-700 text-slate-300 hover:text-white' : 'bg-white border-gray-200 text-gray-600 hover:text-gray-900'" class="px-5 py-3 border text-sm font-bold rounded-xl transition shadow-sm">
                        📦 {{ __('messages.product_list') }}
                    </a>

                    <!-- ប៊ូតុងបន្ថែមទំនិញថ្មី -->
                    <a href="{{ route('products.create') }}" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow transition duration-150">
                        + {{ __('messages.add_product') }}
                    </a>
                </div>
            </div>

            <!-- ២. រូបភាពបដាធំរបស់ក្រុមហាងកុំព្យូទ័រ (Featured Luxury PC Setup Banner - Unsplash High-Resolution) -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl h-80 sm:h-96 border-2 border-blue-500/10 hover:border-blue-500/30 transition duration-300">
                <img src="https://images.unsplash.com/photo-1547082299-de196ea013d6?auto=format&fit=crop&w=1200&q=80" 
                     class="w-full h-full object-cover transform scale-105 hover:scale-100 transition duration-700" 
                     alt="PHIROM Computer Setup">
                
                <!-- ម៉ាស់ខ្មៅគ្របពីលើរូបភាព និងបង្ហាញព័ត៌មានលម្អិតបែបកម្រិតខ្ពស់ (Glassmorphism Overlay) -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent flex flex-col justify-end p-6 sm:p-8">
                    <div class="max-w-2xl space-y-3 text-left">
                        <h2 class="text-xl sm:text-3xl font-bold text-white tracking-wide">{{ __('messages.slide_pc_title') }}</h2>
                        <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                            {{ __('messages.slide_pc_desc') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- ៣. ប្រអប់របាយការណ៍សង្ខេបប្រណិត (Overview Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div :class="darkMode ? 'bg-slate-900/60 border-slate-800' : 'bg-white border-gray-200 shadow-sm'" class="p-6 rounded-3xl border transition duration-300">
                    <span class="text-slate-400 text-xs font-bold uppercase">{{ __('messages.total_products') }}</span>
                    <div class="text-3xl font-black text-blue-500 mt-2" x-text="'{{ $totalProducts }}' + ' {{ app()->getLocale() == 'km' ? 'គ្រឿង' : 'Units' }}'"></div>
                </div>
                <div :class="darkMode ? 'bg-slate-900/60 border-slate-800' : 'bg-white border-gray-200 shadow-sm'" class="p-6 rounded-3xl border transition duration-300">
                    <span class="text-slate-400 text-xs font-bold uppercase">{{ __('messages.total_investment') }}</span>
                    <div class="text-3xl font-black text-emerald-500 mt-2">${{ number_format($totalInvestment, 2) }}</div>
                </div>
                <div :class="darkMode ? 'bg-slate-900/60 border-slate-800' : 'bg-white border-gray-200 shadow-sm'" class="p-6 rounded-3xl border transition duration-300">
                    <span class="text-slate-400 text-xs font-bold uppercase">{{ __('messages.expected_revenue') }}</span>
                    <div class="text-3xl font-black text-indigo-500 mt-2">${{ number_format($expectedRevenue, 2) }}</div>
                </div>
            </div>

            <!-- ៤. ផ្នែកបង្ហាញកាតកុំព្យូទ័រជាលក្ខណៈ Thumbnail រូបភាពពិតៗ (Class Thumbnail Cards Grid) -->
            <div class="space-y-6">
                <h3 class="text-lg font-bold" :class="darkMode ? 'text-white' : 'text-gray-900'">💻 {{ __('messages.product_list') }}</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse ($products as $p)
                        <div :class="darkMode ? 'bg-slate-900/60 border-slate-800 hover:border-blue-500/40 hover:bg-slate-900/90' : 'bg-white border-gray-200 hover:border-blue-500/40 hover:shadow-lg'"
                             class="rounded-3xl border overflow-hidden transition duration-300 flex flex-col justify-between">
                            
                            <div>
                                <!-- រូបភាពផលិតផល (គាំទ្រទាំងរូបភាព PC និងលីងអនឡាញ) -->
                                <div class="h-44 bg-slate-800/25 flex items-center justify-center relative overflow-hidden">
                                    @if ($p->image_url)
                                        <img src="{{ str_contains($p->image_url, 'http') ? $p->image_url : asset($p->image_url) }}" class="h-full w-full object-cover" alt="{{ $p->name }}">
                                    @else
                                        <span class="text-5xl">💻</span>
                                    @endif
                                    <span class="absolute top-4 left-4 px-2.5 py-0.5 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-md text-xs font-bold uppercase tracking-wider">{{ $p->brand }}</span>
                                </div>

                                <!-- ព័ត៌មានកុំព្យូទ័រ -->
                                <div class="p-6 space-y-2 text-left">
                                    <h3 :class="darkMode ? 'text-white' : 'text-gray-900'" class="text-base font-bold line-clamp-1 transition duration-300">{{ $p->name }}</h3>
                                    <p class="text-slate-400 text-xs line-clamp-2 h-10 leading-relaxed">{{ $p->specs ?? (app()->getLocale() == 'km' ? 'គ្មានព័ត៌មានលម្អិតបច្ចេកទេស' : 'No specifications available') }}</p>
                                </div>
                            </div>

                            <!-- ផ្នែកគ្រប់គ្រងនៅលើកាត (Actions) -->
                            <div :class="darkMode ? 'border-slate-800/60' : 'border-gray-100'" class="p-6 pt-0 border-t mt-4 space-y-4">
                                <!-- តម្លៃ និងស្តុក -->
                                <div class="flex justify-between items-center pt-4">
                                    <span class="text-lg font-black text-blue-400">${{ number_format($p->selling_price, 2) }}</span>
                                    <span class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-1 rounded-full">
                                        {{ app()->getLocale() == 'km' ? 'ស្តុក' : 'Stock' }} ({{ $p->qty }} {{ app()->getLocale() == 'km' ? 'គ្រឿង' : 'Units' }})
                                    </span>
                                </div>

                                <!-- ប៊ូតុង កែប្រែ / លុប -->
                                <div class="flex space-x-2 pt-2">
                                    <a href="{{ route('products.edit', $p->id) }}" class="w-1/2 text-center py-2.5 bg-gray-500/10 hover:bg-gray-500/20 text-gray-400 hover:text-white rounded-xl text-xs font-bold transition">
                                        {{ __('messages.edit') }}
                                    </a>
                                    <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="w-1/2" onsubmit="return confirm('{{ __('messages.sure_to_delete') }}')">
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
                            <span class="text-5xl block mb-3">📦</span>
                            <p class="text-sm font-semibold">{{ __('messages.out_of_stock') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>