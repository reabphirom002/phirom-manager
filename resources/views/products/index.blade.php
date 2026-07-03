<x-app-layout>
    <!-- បន្ថែម Style ពិសេសសម្រាប់ចលនាស្រអាប់ពន្លឺ (Fade Transition) ពេលប្ដូរទំព័រ -->
    <style>
        body {
            font-family: 'Kantumruy Pro', sans-serif;
        }
        /* ស្ដាររចនាបថអក្សរមេរៀន */
        .rich-text-content strong, .rich-text-content b { font-weight: 700 !important; color: #111827; }
        .rich-text-content em, .rich-text-content i { font-style: italic !important; }
        .rich-text-content u { text-decoration: underline !important; }
        .rich-text-content p { margin-bottom: 0.5rem !important; }

        /* កូដចលនាស្រអាប់ប្ដូរទំព័រយ៉ាងស្មូត (Smooth AJAX Fade Transitions) */
        .ajax-fade-transition {
            transition: opacity 250ms ease-in-out;
            opacity: 1;
        }
        .ajax-fade-out {
            opacity: 0;
        }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.computer_shop') }} &mdash; {{ __('messages.product_list') }}
            </h2>
            <a href="{{ route('products.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm shadow transition duration-150">
                + {{ __('messages.add_product') }}
            </a>
        </div>
    </x-slot>

    <!-- កំណត់ x-data នៅលើ Div ធំ ដើម្បីគ្រប់គ្រងការលោត Popup រូបភាព -->
    <div class="py-12" x-data="{ showModal: false, modalImage: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- ផ្ទាំងរបាយការណ៍សង្ខេបប្រចាំឃ្លាំង -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-400">{{ __('messages.total_products') }}</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalProducts) }} គ្រឿង</h3>
                    </div>
                    <div class="text-2xl bg-blue-50 text-blue-600 p-3 rounded-xl">📦</div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-400">{{ __('messages.total_investment') }}</p>
                        <h3 class="text-2xl font-bold text-gray-950 mt-1">$ {{ number_format($totalInvestment, 2) }}</h3>
                    </div>
                    <div class="text-2xl bg-green-50 text-green-600 p-3 rounded-xl">💰</div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-400">{{ __('messages.expected_revenue') }}</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">$ {{ number_format($expectedRevenue, 2) }}</h3>
                    </div>
                    <div class="text-2xl bg-purple-50 text-purple-600 p-3 rounded-xl">📈</div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between {{ $lowStockCount > 0 ? 'border-red-200 bg-red-50/20' : '' }}">
                    <div>
                        <p class="text-sm font-semibold text-gray-400">{{ __('messages.low_stock') }}</p>
                        <h3 class="text-2xl font-bold mt-1 {{ $lowStockCount > 0 ? 'text-red-600' : 'text-gray-900' }}">{{ $lowStockCount }} មុខ</h3>
                    </div>
                    <div class="text-2xl p-3 rounded-xl {{ $lowStockCount > 0 ? 'bg-red-100 text-red-600 animate-pulse' : 'bg-gray-50 text-gray-400' }}">⚠️</div>
                </div>
            </div>

            @if(session('success'))
                <div class="p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl text-sm flex items-center shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- ផ្ទាំងតារាងទំនិញរួមបញ្ចូលប្រព័ន្ធស្រអាប់ចលនា (ដាក់ ID "inventory-table-container") -->
            <div id="inventory-table-container" class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 ajax-fade-transition">
                <div class="p-6 pb-0">
                    @if($products->isEmpty())
                        <div class="p-12 text-center text-gray-400 font-medium">មិនទាន់មានទំនិញក្នុងស្តុកនៅឡើយទេ។</div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-100 text-gray-400 text-xs font-bold uppercase tracking-wider">
                                        <th class="py-4 px-4">រូបភាព</th>
                                        <th class="py-4 px-4">ទំនិញ</th>
                                        <th class="py-4 px-4">{{ __('messages.specs') }}</th>
                                        <th class="py-4 px-4 text-center">{{ __('messages.qty') }}</th>
                                        <th class="py-4 px-4 text-right">{{ __('messages.buying_price') }}</th>
                                        <th class="py-4 px-4 text-right">{{ __('messages.selling_price') }}</th>
                                        <th class="py-4 px-4 text-right">សកម្មភាព</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 text-sm">
                                    @foreach($products as $product)
                                        <tr class="hover:bg-gray-50/50 transition">
                                            <td class="py-4 px-4">
                                                @if($product->image_url)
                                                    @php 
                                                        $fullImgUrl = str_contains($product->image_url, 'http') ? $product->image_url : asset($product->image_url);
                                                    @endphp
                                                    <img src="{{ $fullImgUrl }}" 
                                                         @click="modalImage = '{{ $fullImgUrl }}'; showModal = true"
                                                         class="w-24 h-16 rounded-xl object-cover border border-gray-100 shadow-sm cursor-zoom-in hover:opacity-90 transition duration-150" 
                                                         title="ចុចទីនេះដើម្បីពង្រីករូបភាពច្បាស់"
                                                         alt="Product Image">
                                                @else
                                                    <div class="w-24 h-16 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400 font-bold text-xs">💻</div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="font-bold text-gray-900 text-base leading-tight">{{ $product->name }}</div>
                                                <div class="text-xs text-blue-600 font-bold uppercase mt-1">{{ $product->brand }} &bull; {{ $product->warranty ?? 'No Warranty' }}</div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-xs text-gray-500 max-w-xs break-words whitespace-normal leading-relaxed">
                                                    {{ $product->specs ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                @if($product->qty == 0)
                                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-red-50 text-red-600">{{ __('messages.out_of_stock') }}</span>
                                                @elseif($product->qty <= 5)
                                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-600">{{ $product->qty }} គ្រឿង (ជិតអស់)</span>
                                                @else
                                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-green-50 text-green-600">{{ $product->qty }} គ្រឿង</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4 text-right text-gray-600 font-semibold">$ {{ number_format($product->buying_price, 2) }}</td>
                                            <td class="py-4 px-4 text-right text-blue-600 font-bold">$ {{ number_format($product->selling_price, 2) }}</td>
                                            <td class="py-4 px-4 text-right">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-1.5 border border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold rounded-lg text-xs transition">
                                                        {{ __('messages.edit') }}
                                                    </a>
                                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.sure_to_delete') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-lg text-xs transition">
                                                            {{ __('messages.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- ប៊ូតុងប្ដូរទំព័រ -->
                @if(!$products->isEmpty())
                    <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

        </div>

        <!-- ផ្ទាំងចលនាពង្រីករូបភាពធំប្រណីតច្បាស់ៗ -->
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

    <!-- កូដរហ័សដំណើរការ AJAX Pagination យ៉ាងស្មូតដោយមិនបាច់ព្រិចទំព័រ (Ultra-Smooth AJAX Pagination) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tableContainer = document.getElementById('inventory-table-container');

            // ចាប់យកព្រឹត្តិការណ៍ចុច (Click Events) លើរាល់លីងប្តូរទំព័រទាំងអស់
            tableContainer.addEventListener('click', function (e) {
                const targetLink = e.target.closest('nav a, .pagination a');
                // ធានាថាក្រុមការងារចុចលើលីងប្ដូរទំព័រពិតប្រាកដក្នុងកាតតារាង
                if (targetLink && tableContainer.contains(targetLink)) {
                    e.preventDefault(); // ទប់ស្កាត់ការលោត Refresh (Page Reload) របស់ Browser
                    const pageUrl = targetLink.getAttribute('href');
                    if (pageUrl) {
                        changeInventoryPage(pageUrl);
                    }
                }
            });

            // មុខងារដូរទំព័រស្ងាត់ៗជាមួយចលនាស្រអាប់ពន្លឺ
            function changeInventoryPage(url) {
                // ១. ចាប់ផ្ដើមស្រអាប់បិទតារាងចាស់ (Fade Out - 250ms)
                tableContainer.classList.add('ajax-fade-out');

                setTimeout(() => {
                    // ២. ទាញយកកូដទំព័រថ្មីពីអ៊ីនធឺណិតស្ងាត់ៗ (Fetch API)
                    fetch(url)
                        .then(response => response.text())
                        .then(htmlText => {
                            // ៣. បម្លែងអត្ថបទទៅជាកូដ HTML
                            const domParser = new DOMParser();
                            const newHtmlDoc = domParser.parseFromString(htmlText, 'text/html');
                            const newTableBody = newHtmlDoc.getElementById('inventory-table-container').innerHTML;

                            // ៤. ជំនួសតារាងចាស់ដោយតារាងថ្មីស្ងៀមៗ
                            tableContainer.innerHTML = newTableBody;

                            // ៥. ធ្វើបច្ចុប្បន្នភាពអាសយដ្ឋាន URL លើ Browser ដោយមិនបាច់ Reload (History API)
                            window.history.pushState({}, '', url);

                            // ៦. ធ្វើឱ្យតារាងថ្មីលេចពន្លឺឡើងវិញយ៉ាងរលូន (Fade In)
                            tableContainer.classList.remove('ajax-fade-out');
                        })
                        .catch(error => {
                            console.error('Failed to change page via AJAX:', error);
                            tableContainer.classList.remove('ajax-fade-out');
                        });
                }, 250); // រយៈពេល ២៥០ មីលីវិនាទី (ស្មើជាមួយ CSS Transition)
            }
        });
    </script>
</x-app-layout>