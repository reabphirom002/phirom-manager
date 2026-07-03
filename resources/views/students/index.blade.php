<x-app-layout>
    <!-- Style បន្ថែមសម្រាប់ចលនាស្រអាប់ពេលប្ដូរទំព័រ -->
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; }
        .ajax-fade-transition { transition: opacity 250ms ease-in-out; opacity: 1; }
        .ajax-fade-out { opacity: 0; }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.students') }}
            </h2>
            <a href="{{ route('students.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm shadow transition">
                + {{ __('messages.add_student') }}
            </a>
        </div>
    </x-slot>

    <!-- កំណត់ x-data លើ Div ធំ ដើម្បីដំណើរការ Lightbox Popup រូបសិស្ស -->
    <div class="py-12" x-data="{ showModal: false, modalImage: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl text-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- ផ្ទាំងកាតតារាងរួមបញ្ចូលប្រព័ន្ធស្រអាប់ចលនា AJAX -->
            <div id="inventory-table-container" class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 ajax-fade-transition">
                <div class="p-6 pb-0">
                    
                    @if($students->isEmpty())
                        <div class="p-12 text-center text-gray-400 font-medium">
                            មិនទាន់មានសិស្សចុះឈ្មោះសិក្សានៅឡើយទេ។
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-100 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                                        <th class="py-4 px-4">{{ __('messages.photo') }}</th>
                                        <th class="py-4 px-4">{{ __('messages.name') }}</th>
                                        <th class="py-4 px-4">{{ __('messages.course') }}</th>
                                        <th class="py-4 px-4">{{ __('messages.class_name') }} / កាលវិភាគ</th>
                                        <th class="py-4 px-4">{{ __('messages.phone') }}</th>
                                        <th class="py-4 px-4">{{ __('messages.enrollment_date') }}</th>
                                        <th class="py-4 px-4 text-center">{{ __('messages.status') }}</th>
                                        <th class="py-4 px-4 text-right">សកម្មភាព</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 text-sm">
                                    @foreach($students as $student)
                                        <tr class="hover:bg-gray-50/50 transition">
                                            <!-- រូបថតសិស្សជាវង់មូលស្អាត អាចចុចពង្រីកបាន -->
                                            <td class="py-4 px-4">
                                                @if($student->photo_url)
                                                    @php $fullPhotoUrl = str_contains($student->photo_url, 'http') ? $student->photo_url : asset($student->photo_url); @endphp
                                                    <img src="{{ $fullPhotoUrl }}" 
                                                         @click="modalImage = '{{ $fullPhotoUrl }}'; showModal = true"
                                                         class="w-12 h-12 rounded-full object-cover border border-gray-100 shadow-sm cursor-zoom-in hover:opacity-90 transition duration-150" 
                                                         title="ចុចពង្រីករូបថតសិស្ស" alt="Student">
                                                @else
                                                    <!-- បង្ហាញរូប Avatar ជំនួសបើគ្មានរូបភាព -->
                                                    <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm">
                                                        {{ mb_substr($student->name, 0, 1, 'utf-8') }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4 font-bold text-gray-900">{{ $student->name }}</td>
                                            <td class="py-4 px-4">
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-blue-50 text-blue-600">
                                                    {{ $student->course->name ?? 'General' }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-4">
                                                @if($student->classroom)
                                                    <div class="font-bold text-gray-800">{{ $student->classroom->name }}</div>
                                                    <div class="text-xs text-gray-500 font-medium mt-0.5">👨‍🏫 {{ $student->classroom->teacher_name }} ({{ $student->classroom->time_slot }})</div>
                                                @else
                                                    <span class="text-xs text-gray-400 font-semibold">- មិនទាន់ចូលថ្នាក់ -</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4 text-gray-600 font-semibold">{{ $student->phone ?? '-' }}</td>
                                            <td class="py-4 px-4 text-gray-500">{{ $student->enrollment_date }}</td>
                                            <td class="py-4 px-4 text-center">
                                                <span class="px-3 py-1 text-xs font-bold rounded-full
                                                    {{ $student->status == 'active' ? 'bg-green-50 text-green-700' : '' }}
                                                    {{ $student->status == 'completed' ? 'bg-blue-50 text-blue-700' : '' }}
                                                    {{ $student->status == 'dropped' ? 'bg-red-50 text-red-700' : '' }}
                                                ">
                                                    {{ __('messages.' . $student->status) }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-4 text-right">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('students.edit', $student->id) }}" class="px-3 py-1.5 border border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold rounded-lg text-xs transition">
                                                        {{ __('messages.edit') }}
                                                    </a>
                                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.sure_to_delete') }}')">
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

                <!-- ប៊ូតុងប្ដូរទំព័រ (Pagination Links) -->
                @if(!$students->isEmpty())
                    <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                        {{ $students->links() }}
                    </div>
                @endif
            </div>

        </div>

        <!-- ផ្ទាំងចលនាពង្រីករូបថតសិស្សធំច្បាស់ៗ (Lightbox Modal) -->
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
            <div class="relative max-w-md max-h-[85vh] overflow-hidden rounded-2xl shadow-2xl border border-white/10">
                <img :src="modalImage" class="max-w-full max-h-[80vh] object-contain rounded-2xl" alt="Large Student Image">
            </div>
        </div>

    </div>

    <!-- AJAX Pagination Script សម្រាប់សិស្ស (រលូនមិនលោតព្រិចអេក្រង់) -->
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
    </script>
</x-app-layout>