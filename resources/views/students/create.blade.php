<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.add_student') }}
            </h2>
            <a href="{{ route('students.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 sm:p-10 border border-gray-100">
                
                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- ឈ្មោះសិស្សពេញ -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.name') }} <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="បញ្ចូលឈ្មោះពេញរបស់សិស្ស..." class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('name') }}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- លេខទូរស័ព្ទ និង អ៊ីមែល -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.phone') }}</label>
                            <input type="text" name="phone" placeholder="ឧទាហរណ៍៖ 012 345 678" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('phone') }}">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.email') }}</label>
                            <input type="email" name="email" placeholder="ឧទាហរណ៍៖ student@gmail.com" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <!-- ប្រព័ន្ធរូបថតសិស្ស ២ ជម្រើស (អាប់ឡូតរូប ឬលីង URL) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-blue-50/30 p-5 rounded-2xl border border-blue-100">
                        <div class="p-4 bg-white rounded-xl border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">ជម្រើសទី ១៖ អាប់ឡូតរូបថតសិស្សពីកុំព្យូទ័រ</label>
                            <input type="file" name="photo_file" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                            <x-input-error :messages="$errors->get('photo_file')" class="mt-2" />
                        </div>

                        <div class="p-4 bg-white rounded-xl border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">ជម្រើសទី ២៖ ឬវាយបញ្ចូលលីងរូបថត (URL)</label>
                            <input type="url" name="photo_url" placeholder="https://www.example.com/student.jpg" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-2.5 px-3 shadow-sm text-sm" value="{{ old('photo_url') }}">
                            <x-input-error :messages="$errors->get('photo_url')" class="mt-2" />
                        </div>
                    </div>

                    <!-- វគ្គសិក្សា និង ថ្នាក់រៀន -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- ជ្រើសរើសវគ្គសិក្សា -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.course') }} <span class="text-red-500">*</span></label>
                            <div class="flex space-x-2">
                                <select name="course_id" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition">
                                    <option value="">-- {{ __('messages.select_type') }} --</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }} ($ {{ number_format($course->fee, 2) }})</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('courses.index') }}" target="_blank" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm flex items-center shadow-sm transition" title="គ្រប់គ្រងវគ្គសិក្សា">+</a>
                            </div>
                            <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
                        </div>

                        <!-- ជ្រើសរើសថ្នាក់រៀន -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.class_name') }} / កាលវិភាគ</label>
                            <div class="flex space-x-2">
                                <select name="classroom_id" class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition">
                                    <option value="">-- {{ __('messages.select_class') }} (មិនបង្ខំ) --</option>
                                    @foreach($classrooms as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }} ({{ $class->time_slot }} - {{ $class->days }})</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('classrooms.index') }}" target="_blank" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm flex items-center shadow-sm transition" title="គ្រប់គ្រងថ្នាក់រៀន">+</a>
                            </div>
                            <x-input-error :messages="$errors->get('classroom_id')" class="mt-2" />
                        </div>
                    </div>

                    <!-- ថ្ងៃចូលរៀន និង ស្ថានភាពសិក្សា -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- ថ្ងៃចូលរៀន -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.enrollment_date') }} <span class="text-red-500">*</span></label>
                            <input type="date" name="enrollment_date" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition" value="{{ old('enrollment_date', date('Y-m-d')) }}">
                            <x-input-error :messages="$errors->get('enrollment_date')" class="mt-2" />
                        </div>

                        <!-- ស្ថានភាពសិក្សា -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.status') }} <span class="text-red-500">*</span></label>
                            <select name="status" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition">
                                <option value="active">{{ __('messages.active') }}</option>
                                <option value="completed">{{ __('messages.completed') }}</option>
                                <option value="dropped">{{ __('messages.dropped') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>

                    <!-- កំណត់ចំណាំផ្សេងៗ -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.notes') }}</label>
                        <textarea name="notes" rows="4" placeholder="សរសេរព័ត៌មានបន្ថែម ឬកំណត់ចំណាំរបស់សិស្សម្នាក់នេះ..." class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-3 px-4 shadow-sm transition">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <!-- ប៊ូតុង រក្សាទុក -->
                    <div class="pt-4">
                        <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition duration-150 text-base">
                            {{ __('messages.add_student') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>