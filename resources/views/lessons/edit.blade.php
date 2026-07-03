<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.js"></script>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.edit_lesson') }}
            </h2>
            <a href="{{ route('lessons.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition duration-150">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 sm:p-10 border border-gray-100">
                
                <form action="{{ route('lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="lesson-form">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.lesson_title') }} *</label>
                        <input type="text" name="title" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500/20 py-3 px-4 shadow-sm transition" value="{{ $lesson->title }}">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.lesson_type') }} *</label>
                            <select name="type" id="lesson-type" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500/20 py-3 px-4 shadow-sm transition">
                                <option value="pdf" {{ $lesson->type == 'pdf' ? 'selected' : '' }}>📄 PDF</option>
                                <option value="word" {{ $lesson->type == 'word' ? 'selected' : '' }}>📝 Word Document</option>
                                <option value="image" {{ $lesson->type == 'image' ? 'selected' : '' }}>🖼️ Image (រូបភាព)</option>
                                <option value="video" {{ $lesson->type == 'video' ? 'selected' : '' }}>🎥 YouTube Video</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.category') }} *</label>
                            <div class="flex space-x-2">
                                <select name="category_id" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500/20 py-3 px-4 shadow-sm transition">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $lesson->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('categories.index') }}" target="_blank" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm flex items-center shadow-sm transition">+</a>
                            </div>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                    </div>

                    <div id="youtube-field-container" class="bg-red-50/50 p-5 rounded-2xl border border-red-100 hidden">
                        <label class="block text-sm font-semibold text-red-800 mb-2">{{ __('messages.youtube_url') }}</label>
                        <input type="url" name="youtube_url" class="w-full rounded-xl border-red-200 focus:border-red-500 focus:ring-red-500/20 py-3 px-4 shadow-sm transition" value="{{ $lesson->youtube_url }}">
                        <x-input-error :messages="$errors->get('youtube_url')" class="mt-2" />
                    </div>

                    <!-- ៤. ផ្នែកអាប់ឡូតឯកសារមេរៀន និង រូបភាពតំណាង (កូដលុប Class hidden ចេញពីស៊ុមរួមខាងក្រៅ) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- ប្រអប់អាប់ឡូតឯកសារមេរៀន (កែតម្រូវឈ្មោះ ID ទៅជា file-field-container) -->
                        <div id="file-field-container" class="p-5 bg-gray-50 rounded-2xl border border-dashed border-gray-300 hover:border-blue-500 transition flex flex-col justify-between hidden">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('messages.upload_file') }} (ប្ដូរថ្មី)</label>
                                <input type="file" name="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            </div>
                            
                            @if($lesson->file_path)
                                <div class="mt-4 p-3 bg-white rounded-xl border border-gray-100 flex items-center justify-between shadow-sm">
                                    <span class="text-xs font-semibold text-gray-500">📄 មានឯកសារចាស់ស្រាប់</span>
                                    <a href="{{ asset('storage/' . $lesson->file_path) }}" target="_blank" class="text-xs font-bold text-blue-600 hover:underline">ចុចមើលឯកសារ</a>
                                </div>
                            @endif
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <!-- ប្រអប់អាប់ឡូតរូបភាពតំណាង (កែតម្រូវឈ្មោះ ID ទៅជា thumbnail-field-container) -->
                        <div id="thumbnail-field-container" class="p-5 bg-gray-50 rounded-2xl border border-dashed border-gray-300 hover:border-blue-500 transition flex flex-col justify-between">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('messages.custom_thumbnail') }} (ប្ដូរថ្មី)</label>
                                <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            </div>
                            
                            @if($lesson->thumbnail)
                                <div class="mt-4 p-2 bg-white rounded-xl border border-gray-100 flex items-center space-x-3 shadow-sm">
                                    <img src="{{ str_contains($lesson->thumbnail, 'http') ? $lesson->thumbnail : asset('storage/' . $lesson->thumbnail) }}" class="w-12 h-12 rounded-lg object-cover border" alt="Old Thumbnail">
                                    <span class="text-xs font-semibold text-gray-500">🖼️ រូបភាពក្របបច្ចុប្បន្ន</span>
                                </div>
                            @endif
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        </div>
                    </div>

                    <!-- ៥. ការពិពណ៌នាលម្អិត -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.description') }}</label>
                        <div class="rounded-xl border border-gray-300 overflow-hidden shadow-sm">
                            <div id="editor-container" class="bg-white min-h-[200px] text-base" style="font-family: 'Kantumruy Pro', sans-serif;">{!! $lesson->description !!}</div>
                        </div>
                        <input type="hidden" name="description" id="description-input">
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition">
                        {{ __('messages.update_lesson') }}
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- Javascript គ្រប់គ្រង ID ត្រូវគ្នាទាំងស្រុង -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quill = new Quill('#editor-container', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['link'], 
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['clean']
                    ]
                }
            });

            const form = document.getElementById('lesson-form');
            form.onsubmit = function() {
                const descriptionInput = document.getElementById('description-input');
                descriptionInput.value = quill.root.innerHTML;
            };

            const typeSelect = document.getElementById('lesson-type');
            const fileContainer = document.getElementById('file-field-container');
            const thumbnailContainer = document.getElementById('thumbnail-field-container');
            const youtubeContainer = document.getElementById('youtube-field-container');

            function toggleFields() {
                const selectedType = typeSelect.value;

                if (selectedType === 'video') {
                    youtubeContainer.classList.remove('hidden');
                    fileContainer.classList.add('hidden');
                    thumbnailContainer.classList.add('md:col-span-2');
                } else if (selectedType === 'pdf' || selectedType === 'word' || selectedType === 'image') {
                    fileContainer.classList.remove('hidden');
                    youtubeContainer.classList.add('hidden');
                    thumbnailContainer.classList.remove('md:col-span-2');
                } else {
                    fileContainer.classList.add('hidden');
                    youtubeContainer.classList.add('hidden');
                    thumbnailContainer.classList.add('md:col-span-2');
                }
            }

            typeSelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
</x-app-layout>