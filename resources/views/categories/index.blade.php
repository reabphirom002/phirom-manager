<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                គ្រប់គ្រងវគ្គសិក្សា / ក្រុមឯកសារ (Category Manager)
            </h2>
            <a href="{{ route('lessons.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition duration-150">
                &larr; {{ __('messages.back') }}
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- ផ្នែកខាងឆ្វេង៖ Form បង្កើត Category ថ្មី -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-fit">
                    <h3 class="font-bold text-lg mb-4 text-gray-900">បន្ថែមវគ្គសិក្សាថ្មី</h3>
                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">ឈ្មោះវគ្គសិក្សា / ឈ្មោះក្រុម</label>
                            <input type="text" name="name" required placeholder="ឧទាហរណ៍៖ ថ្នាក់រៀន Photoshop" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-3 px-4">
                        </div>
                        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow transition">+ បង្កើតថ្មី</button>
                    </form>
                </div>

                <!-- ផ្នែកខាងស្ដាំ៖ បញ្ជីបង្ហាញ Category ដែលមានស្រាប់ និងប្រព័ន្ធកែសម្រួលផ្ទាល់ក្នុងជួរ -->
                <div class="md:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-lg mb-4 text-gray-900">វគ្គសិក្សាដែលមានស្រាប់</h3>
                    
                    @if($categories->isEmpty())
                        <p class="text-gray-400">មិនទាន់មានវគ្គសិក្សាត្រូវបានបង្កើតឡើយ។</p>
                    @else
                        <div class="divide-y divide-gray-100">
                            @foreach($categories as $cat)
                                <!-- ប្រើប្រាស់ AlpineJS (x-data) ដើម្បីគ្រប់គ្រងការបិទ/បើកប្រអប់កែសម្រួលយ៉ាងលឿន -->
                                <div x-data="{ editing: false, name: '{{ $cat->name }}' }" class="py-3.5">
                                    
                                    <!-- កំណែទី ១៖ បង្ហាញឈ្មោះធម្មតា (ពេលមិនទាន់កែសម្រួល) -->
                                    <div x-show="!editing" class="flex justify-between items-center w-full">
                                        <span class="font-semibold text-gray-800">{{ $cat->name }}</span>
                                        <div class="flex space-x-2">
                                            <!-- ប៊ូតុងចុច Edit -->
                                            <button @click="editing = true" class="text-xs bg-gray-50 hover:bg-gray-100 text-gray-600 px-3 py-1.5 font-semibold rounded-lg transition">
                                                {{ __('messages.edit') }}
                                            </button>
                                            <!-- ប៊ូតុងលុបចោល -->
                                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបវគ្គសិក្សានេះមែនទេ? (មេរៀនក្នុងក្រុមនេះនឹងត្រូវប្ដូរទៅជា General)')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 font-semibold rounded-lg transition">
                                                    {{ __('messages.delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- កំណែទី ២៖ បង្ហាញទម្រង់ប្រអប់កែប្រែ (ពេលចុច Edit រួច) -->
                                    <div x-show="editing" x-cloak class="w-full">
                                        <form action="{{ route('categories.update', $cat->id) }}" method="POST" class="flex items-center space-x-2 w-full">
                                            @csrf
                                            @method('PUT')
                                            
                                            <input type="text" name="name" x-model="name" required class="flex-1 rounded-xl border-gray-300 py-1.5 px-3 text-sm focus:border-blue-500 shadow-sm">
                                            
                                            <button type="submit" class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-3.5 py-2 font-bold rounded-lg transition">
                                                រក្សាទុក
                                            </button>
                                            
                                            <button type="button" @click="editing = false; name = '{{ $cat->name }}'" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3.5 py-2 font-bold rounded-lg transition">
                                                បោះបង់
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>