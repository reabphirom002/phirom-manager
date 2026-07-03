<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">គ្រប់គ្រងក្រុមប្រភេទភេសជ្ជៈ (Beverage Category Manager)</h2>
            <a href="{{ route('beverages.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition duration-150">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Form បង្កើតថ្មី -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-fit">
                <h3 class="font-bold text-lg mb-4 text-gray-900">បន្ថែមប្រភេទថ្មី</h3>
                <form action="{{ route('beverage-categories.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">ឈ្មោះប្រភេទភេសជ្ជៈ</label>
                        <input type="text" name="name" required placeholder="ឧទាហរណ៍៖ Smoothies, Milk Tea" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-3 px-4">
                    </div>
                    <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow transition">+ បង្កើតថ្មី</button>
                </form>
            </div>

            <!-- បញ្ជីបង្ហាញ និងប្រព័ន្ធកែសម្រួលផ្ទាល់ក្នុងជួរ (Alpine.js) -->
            <div class="md:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-lg mb-4 text-gray-900">ប្រភេទភេសជ្ជៈដែលមានស្រាប់</h3>
                
                @if($categories->isEmpty())
                    <p class="text-gray-400">មិនទាន់មានប្រភេទភេសជ្ជៈត្រូវបានបង្កើតឡើយ។</p>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($categories as $cat)
                            <div x-data="{ editing: false, name: '{{ $cat->name }}' }" class="py-3.5">
                                
                                <div x-show="!editing" class="flex justify-between items-center w-full">
                                    <span class="font-semibold text-gray-800">{{ $cat->name }}</span>
                                    <div class="flex space-x-2">
                                        <button @click="editing = true" class="text-xs bg-gray-50 hover:bg-gray-100 text-gray-600 px-3 py-1.5 font-semibold rounded-lg transition">
                                            {{ __('messages.edit') }}
                                        </button>
                                        <form action="{{ route('beverage-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបប្រភេទភេសជ្ជៈនេះមែនទេ? (ភេសជ្ជៈក្នុងក្រុមនេះនឹងត្រូវប្ដូរទៅជា General)')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 font-semibold rounded-lg transition">លុបចោល</button>
                                        </form>
                                    </div>
                                </div>

                                <div x-show="editing" x-cloak class="w-full">
                                    <form action="{{ route('beverage-categories.update', $cat->id) }}" method="POST" class="flex items-center space-x-2 w-full">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" x-model="name" required class="flex-1 rounded-xl border-gray-300 py-1.5 px-3 text-sm focus:border-blue-500 shadow-sm">
                                        <button type="submit" class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-3.5 py-2 font-bold rounded-lg transition">រក្សាទុក</button>
                                        <button type="button" @click="editing = false; name = '{{ $cat->name }}'" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3.5 py-2 font-bold rounded-lg transition">បោះបង់</button>
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>