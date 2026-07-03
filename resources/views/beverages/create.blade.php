<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.add_beverage') }}
            </h2>
            <a href="{{ route('beverages.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 sm:p-10 border border-gray-100">
                
                <form action="{{ route('beverages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- ឈ្មោះភេសជ្ជៈ -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">ឈ្មោះភេសជ្ជៈ *</label>
                        <input type="text" name="name" required placeholder="ឧទាហរណ៍៖ Espresso, Iced Latte" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('name') }}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- ក្រុមប្រភេទភេសជ្ជៈ និង តម្លៃលក់ (២ ជួរទន្ទឹមគ្នា) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- ប្រអប់ជ្រើសរើសប្រភេទ (ទាញចេញពីតារាង beverage_categories ថ្មី) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">ប្រភេទភេសជ្ជៈ *</label>
                            <div class="flex space-x-2">
                                <select name="beverage_category_id" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition">
                                    <option value="">-- ជ្រើសរើសប្រភេទ --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('beverage-categories.index') }}" target="_blank" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm flex items-center shadow-sm transition" title="គ្រប់គ្រងប្រភេទភេសជ្ជៈ">+</a>
                            </div>
                            <x-input-error :messages="$errors->get('beverage_category_id')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">តម្លៃលក់ ($) *</label>
                            <input type="number" name="price" step="0.01" required placeholder="2.50" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('price') }}">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                    </div>

                    <!-- ប្រព័ន្ធរូបភាព ២ ជម្រើស -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-blue-50/30 p-5 rounded-2xl border border-blue-100">
                        <div class="p-4 bg-white rounded-xl border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">ជម្រើសទី ១៖ អាប់ឡូតរូបភាពពីកុំព្យូទ័រ</label>
                            <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            <x-input-error :messages="$errors->get('image_file')" class="mt-2" />
                        </div>

                        <div class="p-4 bg-white rounded-xl border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">ជម្រើសទី ២៖ ឬវាយបញ្ចូលលីងរូបភាព (URL)</label>
                            <input type="url" name="image_url" placeholder="https://www.example.com/drink.jpg" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-2.5 px-3 shadow-sm text-sm" value="{{ old('image_url') }}">
                            <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                        </div>
                    </div>

                    <!-- រូបមន្ត និងវិធីឆុងរបស់ Barista -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.recipe') }}</label>
                        <textarea name="recipe" rows="6" placeholder="{{ __('messages.enter_recipe') }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition">{{ old('recipe') }}</textarea>
                        <x-input-error :messages="$errors->get('recipe')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition duration-150 text-base">
                        {{ __('messages.add_beverage') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>