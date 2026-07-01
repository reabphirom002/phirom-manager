<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('messages.all_lessons') }}</h2>
            <a href="{{ route('lessons.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm shadow-md hover:shadow-lg transition duration-150">
                + {{ __('messages.add_lesson') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl text-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- របារតម្រងប្ដូរប្រភេទមេរៀន (Tab Filters) -->
            <div class="flex flex-wrap gap-2 mb-8 bg-white p-2 rounded-2xl border border-gray-100 shadow-sm max-w-2xl">
                <button onclick="filterLessons('all')" id="btn-all" class="filter-btn px-5 py-2 text-sm font-semibold rounded-xl transition duration-150 bg-blue-600 text-white shadow-sm">
                    {{ __('messages.all') }}
                </button>
                <button onclick="filterLessons('video')" id="btn-video" class="filter-btn px-5 py-2 text-sm font-semibold rounded-xl transition duration-150 text-gray-600 hover:bg-gray-50">
                    {{ __('messages.all_lessons') ? __('messages.videos') : 'Videos' }}
                </button>
                <button onclick="filterLessons('doc')" id="btn-doc" class="filter-btn px-5 py-2 text-sm font-semibold rounded-xl transition duration-150 text-gray-600 hover:bg-gray-50">
                    {{ __('messages.all_lessons') ? __('messages.documents') : 'Documents' }}
                </button>
                <button onclick="filterLessons('image')" id="btn-image" class="filter-btn px-5 py-2 text-sm font-semibold rounded-xl transition duration-150 text-gray-600 hover:bg-gray-50">
                    {{ __('messages.all_lessons') ? __('messages.images') : 'Images' }}
                </button>
            </div>

            @if($lessons->isEmpty())
                <div class="bg-white p-16 text-center rounded-2xl border border-gray-100 shadow-sm">
                    <p class="text-gray-400 font-medium">{{ __('messages.no_lessons') }}</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($lessons as $lesson)
                        <div class="lesson-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-lg hover:-translate-y-1 transition duration-300"
                             data-type="{{ $lesson->type }}">
                            
                            <!-- Thumbnail Cover (ឥឡូវនេះផ្ទៃខាងលើទាំងមូល គឺអាចចុចបើកឯកសារ ឬវីដេអូបានភ្លាមៗ) -->
                            <a href="{{ $lesson->type == 'video' ? $lesson->youtube_url : ($lesson->file_path ? asset('storage/' . $lesson->file_path) : '#') }}" 
                               target="_blank" 
                               class="relative h-48 bg-gray-50 overflow-hidden block group"
                               title="{{ $lesson->type == 'video' ? __('messages.watch_video') : __('messages.download') }}">
                                
                                @if($lesson->type == 'image' && $lesson->file_path)
                                    <img src="{{ asset('storage/' . $lesson->file_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="Image Lesson">
                                @elseif($lesson->thumbnail)
                                    <img src="{{ str_contains($lesson->thumbnail, 'http') ? $lesson->thumbnail : asset('storage/' . $lesson->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="Cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 font-bold group-hover:scale-105 transition duration-300">
                                        @if($lesson->type == 'pdf')
                                            <svg class="w-16 h-16 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6l-4-4H9z"></path></svg>
                                        @elseif($lesson->type == 'word')
                                            <svg class="w-16 h-16 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6l-4-4H9z"></path></svg>
                                        @endif
                                    </div>
                                @endif

                                <!-- Badge Category & Type -->
                                <span class="absolute top-4 left-4 px-3 py-1 text-xs font-bold rounded-xl bg-gray-900/80 text-white shadow-sm">
                                    {{ $lesson->category->name ?? 'General' }}
                                </span>

                                <span class="absolute top-4 right-4 px-3 py-1 text-xs font-bold rounded-xl text-white uppercase shadow-sm z-10
                                    {{ $lesson->type == 'video' ? 'bg-red-600' : '' }}
                                    {{ $lesson->type == 'pdf' ? 'bg-blue-600' : '' }}
                                    {{ $lesson->type == 'word' ? 'bg-indigo-600' : '' }}
                                    {{ $lesson->type == 'image' ? 'bg-green-600' : '' }}
                                ">
                                    {{ $lesson->type }}
                                </span>
                            </a>

                            <!-- Details -->
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div class="mb-4">
                                    <!-- ចំណងជើងមេរៀន (ចុចដើម្បីពន្លាតបើវែង) -->
                                    <h4 class="font-bold text-lg text-gray-900 mb-2 {{ mb_strlen($lesson->title, 'utf-8') > 25 ? 'cursor-pointer hover:text-blue-600' : '' }}"
                                        @if(mb_strlen($lesson->title, 'utf-8') > 25)
                                            onclick="toggleTitle({{ $lesson->id }})"
                                            title="{{ app()->getLocale() == 'km' ? 'ចុចអានចំណងជើងពេញ' : 'Click to view full title' }}"
                                        @endif>
                                        <span id="title-short-{{ $lesson->id }}" class="block">{{ \Illuminate\Support\Str::limit($lesson->title, 25, '...') }}</span>
                                        @if(mb_strlen($lesson->title, 'utf-8') > 25)
                                            <span id="title-full-{{ $lesson->id }}" class="hidden">{{ $lesson->title }}</span>
                                        @endif
                                    </h4>
                                    
                                    <!-- ផ្នែកការពិពណ៌នា ឌីណាមិក -->
                                    <div class="text-gray-500 text-sm">
                                        <span id="desc-short-{{ $lesson->id }}" class="block" style="white-space: pre-wrap;">{{ \Illuminate\Support\Str::limit($lesson->description ?? 'No description.', 50, '...') }}</span>
                                        <span id="desc-full-{{ $lesson->id }}" class="hidden" style="white-space: pre-wrap;">{{ $lesson->description ?? 'No description.' }}</span>
                                        
                                        @if($lesson->description && mb_strlen($lesson->description, 'utf-8') > 50)
                                            <button onclick="toggleDescription({{ $lesson->id }})" 
                                                    id="btn-desc-{{ $lesson->id }}" 
                                                    data-more="{{ __('messages.read_more') }}" 
                                                    data-less="{{ __('messages.read_less') }}"
                                                    class="text-xs font-bold text-blue-600 hover:text-blue-700 mt-1 focus:outline-none transition">
                                                {{ __('messages.read_more') }}
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <div class="space-y-3 pt-4 border-t border-gray-50">
                                    <!-- ប៊ូតុង Edit & Delete -->
                                    <div class="flex space-x-2">
                                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="flex-1 text-center py-2 border border-gray-200 text-gray-600 hover:bg-gray-50 font-semibold rounded-xl text-xs transition">
                                            {{ __('messages.edit') }}
                                        </a>
                                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" class="flex-1" onsubmit="return confirm('{{ __('messages.sure_to_delete') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-center py-2 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-xl text-xs transition">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    <!-- Javascript -->
    <script>
        // ១. មុខងារ Filter ប្រភេទឯកសារ
        function filterLessons(type) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white', 'shadow-sm');
                btn.classList.add('text-gray-600', 'hover:bg-gray-50');
            });
            
            const activeBtn = document.getElementById('btn-' + type);
            activeBtn.classList.remove('text-gray-600', 'hover:bg-gray-50');
            activeBtn.classList.add('bg-blue-600', 'text-white', 'shadow-sm');

            const cards = document.querySelectorAll('.lesson-card');
            cards.forEach(card => {
                const cardType = card.getAttribute('data-type');
                
                if (type === 'all') {
                    card.style.display = 'flex';
                } else if (type === 'doc') {
                    if (cardType === 'pdf' || cardType === 'word') {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                } else {
                    if (cardType === type) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        }

        // ២. មុខងារចុចពន្លាត និងបង្រួមអក្សរវែង (Read More / Read Less Toggle)
        function toggleDescription(id) {
            const shortDesc = document.getElementById('desc-short-' + id);
            const fullDesc = document.getElementById('desc-full-' + id);
            const btn = document.getElementById('btn-desc-' + id);
            
            const moreText = btn.getAttribute('data-more');
            const lessText = btn.getAttribute('data-less');

            if (fullDesc.classList.contains('hidden')) {
                fullDesc.classList.remove('hidden');
                shortDesc.classList.add('hidden');
                btn.innerText = lessText;
            } else {
                fullDesc.classList.add('hidden');
                shortDesc.classList.remove('hidden');
                btn.innerText = moreText;
            }
        }

        // ៣. មុខងារចុចពន្លាតចំណងជើងមេរៀន (Click to Expand Title)
        function toggleTitle(id) {
            const shortTitle = document.getElementById('title-short-' + id);
            const fullTitle = document.getElementById('title-full-' + id);

            if (fullTitle.classList.contains('hidden')) {
                fullTitle.classList.remove('hidden');
                shortTitle.classList.add('hidden');
            } else {
                fullTitle.classList.add('hidden');
                shortTitle.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>