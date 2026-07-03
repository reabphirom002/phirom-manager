<x-app-layout>
    <!-- នាំចូលឯកសារកូដរបស់ Quill.js (CSS & JS) -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.js"></script>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.add_lesson') }}
            </h2>
            <a href="{{ route('lessons.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition duration-150">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 sm:p-10 border border-gray-100">
                
                <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="lesson-form">
                    @csrf

                    <!-- ១. ចំណងជើងមេរៀន -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.lesson_title') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="title" required placeholder="បញ្ចូលចំណងជើងមេរៀន ឬឯកសារ..." class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500/20 py-3 px-4 shadow-sm transition" value="{{ old('title') }}">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- ២. ប្រភេទមេរៀន និង វគ្គសិក្សា -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- ប្រភេទមេរៀន -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.lesson_type') }} <span class="text-red-500">*</span></label>
                            <select name="type" id="lesson-type" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500/20 py-3 px-4 shadow-sm transition">
                                <option value="">-- {{ __('messages.select_type') }} --</option>
                                <option value="pdf">📄 PDF</option>
                                <option value="word">📝 Word Document</option>
                                <option value="image">🖼️ Image (រូបភាព)</option>
                                <option value="video">🎥 YouTube Video</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <!-- វគ្គសិក្សា -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.category') }} <span class="text-red-500">*</span></label>
                            <div class="flex space-x-2">
                                <select name="category_id" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500/20 py-3 px-4 shadow-sm transition">
                                    <option value="">-- {{ __('messages.select_type') }} --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('categories.index') }}" target="_blank" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm flex items-center shadow-sm transition" title="បង្កើតវគ្គសិក្សាថ្មី">+</a>
                            </div>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                    </div>

                    <!-- ៣. លីងវីដេអូ YouTube -->
                    <div id="youtube-field-container" class="bg-red-50/50 p-5 rounded-2xl border border-red-100 hidden">
                        <label class="block text-sm font-semibold text-red-800 mb-2">{{ __('messages.youtube_url') }} *</label>
                        <input type="url" name="youtube_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full rounded-xl border-red-200 focus:border-red-500 focus:ring-red-500/20 py-3 px-4 shadow-sm transition" value="{{ old('youtube_url') }}">
                        <x-input-error :messages="$errors->get('youtube_url')" class="mt-2" />
                    </div>

                    <!-- ៤. អាប់ឡូតឯកសារមេរៀន និង រូបភាពតំណាង (ស៊ុមរួមខាងក្រៅមិនដាក់ Class hidden ឡើយ) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- ប្រអប់អាប់ឡូតឯកសារមេរៀន (កែតម្រូវឈ្មោះ ID ទៅជា file-field-container គ្មានអក្សរ s ត្រូវជាមួយ JS) -->
                        <div id="file-field-container" class="p-5 bg-gray-50 rounded-2xl border border-dashed border-gray-300 hover:border-blue-500 transition hidden">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('messages.upload_file') }} *</label>
                            <input type="file" name="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            <p class="text-xs text-gray-400 mt-3">គាំទ្រឯកសារប្រភេទ៖ PDF, Word, Image (អតិបរមា 100MB)</p>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <!-- ប្រអប់អាប់ឡូតរូបភាពតំណាង (កែតម្រូវឈ្មោះ ID ទៅជា thumbnail-field-container) -->
                        <div id="thumbnail-field-container" class="p-5 bg-gray-50 rounded-2xl border border-dashed border-gray-300 hover:border-blue-500 transition">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">{{ __('messages.custom_thumbnail') }}</label>
                            <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            <p class="text-xs text-gray-400 mt-3">សម្រាប់រូបភាពក្របតំណាងមេរៀន (PNG, JPG អតិបរមា 2MB)</p>
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        </div>
                    </div>

                    <!-- ៥. ការពិពណ៌នាលម្អិត -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.description') }}</label>
                        <div class="rounded-xl border border-gray-300 overflow-hidden shadow-sm">
                            <div id="editor-container" class="bg-white min-h-[200px] text-base" style="font-family: 'Kantumruy Pro', sans-serif;">{!! old('description') !!}</div>
                        </div>
                        <input type="hidden" name="description" id="description-input">
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition duration-150 text-base">
                            {{ __('messages.save_lesson') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Javascript -->
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