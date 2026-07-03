<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.add_product') }}
            </h2>
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 sm:p-10 border border-gray-100">
                
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- ឈ្មោះទំនិញ និង ម៉ាក -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">ឈ្មោះទំនិញ *</label>
                            <input type="text" name="name" required placeholder="ឧទាហរណ៍៖ MacBook Pro M3" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('name') }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.brand') }} *</label>
                            <input type="text" name="brand" required placeholder="ឧទាហរណ៍៖ Apple, ASUS, Dell" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('brand') }}">
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>
                    </div>

                    <!-- តម្លៃទិញចូល តម្លៃលក់ចេញ និងចំនួនស្តុក -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.buying_price') }} *</label>
                            <input type="number" name="buying_price" step="0.01" required placeholder="1200.00" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('buying_price') }}">
                            <x-input-error :messages="$errors->get('buying_price')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.selling_price') }} *</label>
                            <input type="number" name="selling_price" step="0.01" required placeholder="1499.00" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('selling_price') }}">
                            <x-input-error :messages="$errors->get('selling_price')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.qty') }} *</label>
                            <input type="number" name="qty" required placeholder="10" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('qty') }}">
                            <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                        </div>
                    </div>

                    <!-- រយៈពេលធានា (ពេញមួយជួរ) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.warranty') }}</label>
                        <input type="text" name="warranty" placeholder="ឧទាហរណ៍៖ 1 Year, 6 Months" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('warranty') }}">
                        <x-input-error :messages="$errors->get('warranty')" class="mt-2" />
                    </div>

                    <!-- ប្រព័ន្ធរូបភាព ២ ជម្រើស (អាប់ឡូតផ្ទាល់ខ្លួន និងការផុសលីងមកពីក្រៅ) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-blue-50/30 p-5 rounded-2xl border border-blue-100">
                        <!-- ជម្រើសទី ១៖ អាប់ឡូតពីកុំព្យូទ័រ -->
                        <div class="p-4 bg-white rounded-xl border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">ជម្រើសទី ១៖ អាប់ឡូតរូបភាពពីកុំព្យូទ័រ</label>
                            <input type="file" name="image_file" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            <x-input-error :messages="$errors->get('image_file')" class="mt-2" />
                        </div>

                        <!-- ជម្រើសទី ២៖ វាយលីងពីអ៊ីនធឺណិត -->
                        <div class="p-4 bg-white rounded-xl border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">ជម្រើសទី ២៖ ឬវាយបញ្ចូលលីងរូបភាព (URL)</label>
                            <input type="url" name="image_url" placeholder="https://www.example.com/image.png" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-2.5 px-3 shadow-sm text-sm" value="{{ old('image_url') }}">
                            <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                        </div>
                    </div>

                    <!-- គ្រឿងម៉ាស៊ីន (Specs) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.specs') }}</label>
                        <input type="text" name="specs" placeholder="ឧទាហរណ៍៖ Core i7, 16GB RAM, 512GB SSD, RTX 4060..." class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('specs') }}">
                        <x-input-error :messages="$errors->get('specs')" class="mt-2" />
                    </div>

                    <!-- ការពិពណ៌នាលម្អិត -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.description') }}</label>
                        <textarea name="description" rows="4" placeholder="សរសេរការពិពណ៌នាបន្ថែមអំពីលក្ខណៈពិសេសរបស់ផលិតផលនេះ..." class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition duration-150 text-base">
                        {{ __('messages.add_product') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>