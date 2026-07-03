<x-app-layout>
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; }
        .ajax-fade-transition { transition: opacity 250ms ease-in-out; opacity: 1; }
        .ajax-fade-out { opacity: 0; }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.coffee_shop') }} &mdash; {{ __('messages.beverage_list') }}
            </h2>
            <a href="{{ route('beverages.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm shadow transition duration-150">
                + {{ __('messages.add_beverage') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ showModal: false, modalImage: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- ផ្ទាំងរបាយការណ៍សង្ខេប -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-400">{{ __('messages.total_beverages') }}</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalBeverages) }} មុខ</h3>
                    </div>
                    <div class="text-2xl bg-blue-50 text-blue-600 p-3 rounded-xl">🍹</div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-400">{{ __('messages.average_price') }}</p>
                        <h3 class="text-2xl font-bold text-gray-950 mt-1">$ {{ number_format($averagePrice, 2) }}</h3>
                    </div>
                    <div class="text-2xl bg-green-50 text-green-600 p-3 rounded-xl">💵</div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-400">ក្រុមប្រភេទភេសជ្ជៈ</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $categoriesCount }} ក្រុម</h3>
                    </div>
                    <div class="text-2xl bg-purple-50 text-purple-600 p-3 rounded-xl">☕</div>
                </div>
            </div>

            <!-- របារតម្រងប្ដូរប្រភេទភេសជ្ជៈឌីណាមិក (ទាញយកពី Database ស្វ័យប្រវត្ត) -->
            <div class="flex flex-wrap gap-2 mb-8 bg-white p-2 rounded-2xl border border-gray-100 shadow-sm max-w-4xl">
                <button onclick="filterLessons('all')" id="btn-all" class="filter-btn px-5 py-2 text-sm font-semibold rounded-xl transition duration-150 bg-blue-600 text-white shadow-sm">
                    {{ __('messages.all') }}
                </button>
                @foreach($categories as $cat)
                    <button onclick="filterLessons('cat-{{ $cat->id }}')" id="btn-cat-{{ $cat->id }}" class="filter-btn px-5 py-2 text-sm font-semibold rounded-xl transition duration-150 text-gray-600 hover:bg-gray-50">
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>

            @if(session('success'))
                <div class="p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl text-sm flex items-center shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- កាតបង្ហាញភេសជ្ជៈ -->
            <div id="inventory-table-container" class="space-y-8 ajax-fade-transition">
                @if($beveragesPaginated->isEmpty())
                    <div class="bg-white p-16 text-center rounded-2xl border border-gray-100 shadow-sm">
                        <p class="text-gray-400 font-medium">មិនទាន់មានភេសជ្ជៈក្នុងម៉ឺនុយនៅឡើយទេ។</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($beveragesPaginated as $bev)
                            <div class="lesson-card bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-lg hover:-translate-y-1 transition duration-300"
                                 data-type="cat-{{ $bev->beverage_category_id }}">
                                
                                <div class="relative h-56 bg-gray-50 overflow-hidden cursor-zoom-in group">
                                    @if($bev->image_url)
                                        @php $fullImgUrl = str_contains($bev->image_url, 'http') ? $bev->image_url : asset($bev->image_url); @endphp
                                        <img src="{{ $fullImgUrl }}" 
                                             @click="modalImage = '{{ $fullImgUrl }}'; showModal = true"
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="Beverage">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 font-bold text-3xl">🍹</div>
                                    @endif

                                    <!-- ឈ្មោះក្រុមប្រភេទភេសជ្ជៈឌីណាមិក -->
                                    <span class="absolute top-4 left-4 px-3 py-1 text-xs font-bold rounded-xl bg-gray-900/80 text-white shadow-sm uppercase">
                                        {{ $bev->category->name ?? 'General' }}
                                    </span>
                                    <span class="absolute top-4 right-4 px-3.5 py-1 text-sm font-bold rounded-xl bg-green-600 text-white shadow-md">
                                        $ {{ number_format($bev->price, 2) }}
                                    </span>
                                </div>

                                <div class="p-6 flex-1 flex flex-col justify-between" x-data="{ openRecipe: false }">
                                    <div>
                                        <h4 class="font-bold text-xl text-gray-900 mb-3 leading-tight">{{ $bev->name }}</h4>
                                        
                                        @if($bev->recipe)
                                            <button @click="openRecipe = !openRecipe" class="text-xs font-bold text-amber-600 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-lg focus:outline-none transition mb-4">
                                                <span x-show="!openRecipe">📖 {{ __('messages.view_recipe') }}</span>
                                                <span x-show="openRecipe">❌ លាក់រូបមន្ត</span>
                                            </button>

                                            <div class="rich-text-content" x-show="openRecipe" x-cloak
                                                 x-transition:enter="transition ease-out duration-200"
                                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                                 style="white-space: pre-wrap;">
                                                <div class="p-4 bg-amber-50/40 rounded-2xl border border-amber-100 text-xs text-amber-900 leading-relaxed">
                                                    {{ $bev->recipe }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex space-x-2 pt-4 border-t border-gray-50">
                                        <a href="{{ route('beverages.edit', $bev->id) }}" class="flex-1 text-center py-2 border border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold rounded-xl text-xs transition">
                                            {{ __('messages.edit') }}
                                        </a>
                                        <form action="{{ route('beverages.destroy', $bev->id) }}" method="POST" class="flex-1" onsubmit="return confirm('{{ __('messages.sure_to_delete') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-center py-2 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-xl text-xs transition">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <!-- ប៊ូតុងប្ដូរទំព័រ -->
                    <div class="p-6 bg-white rounded-3xl border border-gray-100 shadow-sm mt-8">
                        {{ $beveragesPaginated->links() }}
                    </div>
                @endif
            </div>

        </div>

        <!-- ផ្ទាំងចលនាពង្រីករូបភាព -->
        <div x-show="showModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             x-cloak
             @click="showModal = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/85 p-4 cursor-zoom-out">
            <div class="relative max-w-4xl max-h-[85vh] overflow-hidden rounded-2xl shadow-2xl border border-white/10">
                <img :src="modalImage" class="max-w-full max-h-[80vh] object-contain rounded-2xl" alt="Large Product Image">
            </div>
        </div>

    </div>

    <!-- Javascript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tableContainer = document.getElementById('inventory-table-container');

            tableContainer.addEventListener('click', function (e) {
                const targetLink = e.target.closest('nav a, .pagination a');
                if (targetLink && tableContainer.contains(targetLink)) {
                    e.preventDefault();
                    const pageUrl = targetLink.getAttribute('href');
                    if (pageUrl) {
                        changeInventoryPage(pageUrl);
                    }
                }
            });

            function changeInventoryPage(url) {
                tableContainer.classList.add('ajax-fade-out');

                setTimeout(() => {
                    fetch(url)
                        .then(response => response.text())
                        .then(htmlText => {
                            const domParser = new DOMParser();
                            const newHtmlDoc = domParser.parseFromString(htmlText, 'text/html');
                            const newTableBody = newHtmlDoc.getElementById('inventory-table-container').innerHTML;

                            tableContainer.innerHTML = newTableBody;
                            window.history.pushState({}, '', url);
                            tableContainer.classList.remove('ajax-fade-out');
                        })
                        .catch(error => {
                            console.error('Failed to change page via AJAX:', error);
                            tableContainer.classList.remove('ajax-fade-out');
                        });
                }, 250);
            }
        });

        // មុខងារបោះត្រង Tabs ប្រភេទភេសជ្ជៈឌីណាមិក
        function filterLessons(type) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white', 'shadow-sm');
                btn.classList.add('text-gray-600', 'hover:bg-gray-50');
            });
            
            // ប្រសិនបើជា All គឺវាយ id=btn-all ផ្ទាល់ តែបើប្រភេទដទៃគឺ id=btn-cat-ID
            const activeBtn = document.getElementById(type === 'all' ? 'btn-all' : 'btn-' + type);
            if (activeBtn) {
                activeBtn.classList.remove('text-gray-600', 'hover:bg-gray-50');
                activeBtn.classList.add('bg-blue-600', 'text-white', 'shadow-sm');
            }

            const cards = document.querySelectorAll('.lesson-card');
            cards.forEach(card => {
                const cardType = card.getAttribute('data-type');
                
                if (type === 'all') {
                    card.style.display = 'flex';
                } else {
                    if (cardType === type) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        }
    </script>
</x-app-layout>