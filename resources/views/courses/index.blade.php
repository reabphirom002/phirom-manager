<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.manage_courses') }}
            </h2>
            <a href="{{ route('students.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition duration-150">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- ផ្នែកខាងឆ្វេង៖ Form បង្កើតវគ្គសិក្សាថ្មី -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-fit">
                <h3 class="font-bold text-lg mb-4 text-gray-900">{{ __('messages.add_course') }}</h3>
                
                <form action="{{ route('courses.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.course_name') }} *</label>
                        <input type="text" name="name" required placeholder="ឧទាហរណ៍៖ Full Stack Web Development" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-3 px-4">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.fee') }} *</label>
                            <input type="number" name="fee" step="0.01" required placeholder="120.00" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-3 px-4">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.duration') }}</label>
                            <input type="text" name="duration" placeholder="3 Months" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-3 px-4">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.description') }}</label>
                        <textarea name="description" rows="3" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow transition">+ {{ __('messages.add_course') }}</button>
                </form>
            </div>

            <!-- ផ្នែកខាងស្ដាំ៖ បញ្ជីបង្ហាញវគ្គសិក្សា (កាតកែសម្រួលឌីណាមិក) -->
            <div class="md:col-span-2 space-y-6">
                @if(session('success'))
                    <div class="p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl text-sm flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @if($courses->isEmpty())
                        <div class="col-span-2 bg-white p-12 text-center text-gray-400 rounded-2xl border border-gray-100">
                            មិនទាន់មានវគ្គសិក្សាត្រូវបានបង្កើតឡើយ។
                        </div>
                    @else
                        @foreach($courses as $course)
                            <!-- ប្រើប្រាស់ AlpineJS ដើម្បីគ្រប់គ្រងការបិទ/បើកប្រអប់កែសម្រួលក្នុងកាតនីមួយៗយ៉ាងរលូន -->
                            <div x-data="{ editing: false, name: '{{ $course->name }}', fee: '{{ $course->fee }}', duration: '{{ $course->duration }}', description: '{{ $course->description }}' }" 
                                 class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                                
                                <!-- កំណែទី ១៖ បង្ហាញព័ត៌មានធម្មតា (ពេលមិនទាន់ចុច Edit) -->
                                <div x-show="!editing" class="flex flex-col justify-between h-full">
                                    <div>
                                        <h4 class="font-bold text-lg text-gray-900 mb-2">{{ $course->name }}</h4>
                                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $course->description ?? 'No description.' }}</p>
                                        
                                        <div class="flex items-center space-x-4 mb-4 text-sm text-gray-700 font-semibold">
                                            <div class="flex items-center space-x-1.5 text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg">
                                                <span>$ {{ number_format($course->fee, 2) }}</span>
                                            </div>
                                            @if($course->duration)
                                                <div class="flex items-center space-x-1.5 text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg">
                                                    <span>🕒 {{ $course->duration }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-50 pt-4 flex justify-end space-x-2">
                                        <!-- ប៊ូតុង Edit -->
                                        <button @click="editing = true" class="text-xs bg-gray-50 hover:bg-gray-100 text-gray-600 px-3.5 py-2 font-bold rounded-lg transition">
                                            {{ __('messages.edit') }}
                                        </button>
                                        <!-- ប៊ូតុង Delete -->
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.sure_to_delete_course') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-3.5 py-2 font-bold rounded-lg transition">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- កំណែទី ២៖ បង្ហាញទម្រង់កែសម្រួលព័ត៌មាន (ពេលចុច Edit) -->
                                <div x-show="editing" x-cloak class="w-full">
                                    <form action="{{ route('courses.update', $course->id) }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 mb-1">ឈ្មោះវគ្គសិក្សា</label>
                                            <input type="text" name="name" x-model="name" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 text-sm py-2 px-3">
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-xs font-bold text-gray-500 mb-1">តម្លៃសិក្សា ($)</label>
                                                <input type="number" name="fee" x-model="fee" step="0.01" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 text-sm py-2 px-3">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-gray-500 mb-1">រយៈពេលសិក្សា</label>
                                                <input type="text" name="duration" x-model="duration" class="w-full rounded-xl border-gray-200 focus:border-blue-500 text-sm py-2 px-3">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 mb-1">ការពិពណ៌នា</label>
                                            <textarea name="description" x-model="description" rows="2" class="w-full rounded-xl border-gray-200 focus:border-blue-500 text-sm"></textarea>
                                        </div>

                                        <div class="flex space-x-2 pt-2 border-t border-gray-50">
                                            <button type="submit" class="flex-1 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg text-xs transition">
                                                រក្សាទុក
                                            </button>
                                            <button type="button" @click="editing = false; name = '{{ $course->name }}'; fee = '{{ $course->fee }}'; duration = '{{ $course->duration }}'; description = '{{ $course->description }}'" class="flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-lg text-xs transition">
                                                បោះបង់
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>