<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.manage_classrooms') }}
            </h2>
            <a href="{{ route('students.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition duration-150">
                &larr; {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- ផ្នែកខាងឆ្វេង៖ Form បង្កើតថ្នាក់រៀនថ្មី -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-fit">
                <h3 class="font-bold text-lg mb-4 text-gray-900">{{ __('messages.add_classroom') }}</h3>
                
                <form action="{{ route('classrooms.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.class_name') }} *</label>
                        <input type="text" name="name" required placeholder="ឧទាហរណ៍៖ Class Web-A1" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-2.5 px-4">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.course_name') }} *</label>
                        <select name="course_id" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-2.5 px-4 shadow-sm">
                            <option value="">-- {{ __('messages.select_type') }} --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.teacher_name') }} *</label>
                        <input type="text" name="teacher_name" required placeholder="ឈ្មោះគ្រូបង្រៀន..." class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-2.5 px-4">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.room') }}</label>
                            <input type="text" name="room" placeholder="Lab 1" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-2.5 px-4">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.status') }} *</label>
                            <select name="status" required class="w-full rounded-xl border-gray-200 focus:border-blue-500 py-2.5 px-4 shadow-sm">
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.days') }} *</label>
                        <input type="text" name="days" required placeholder="ចន្ទ-ពុធ-សុក្រ" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-2.5 px-4">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.time_slot') }} *</label>
                        <input type="text" name="time_slot" required placeholder="08:00 AM - 09:30 AM" class="w-full rounded-xl border-gray-200 focus:border-blue-500 shadow-sm py-2.5 px-4">
                    </div>

                    <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow transition">+ {{ __('messages.add_classroom') }}</button>
                </form>
            </div>

            <!-- ផ្នែកខាងស្ដាំ៖ បញ្ជីបង្ហាញថ្នាក់រៀន (កាតកែសម្រួលឌីណាមិក) -->
            <div class="md:col-span-2 space-y-6">
                @if(session('success'))
                    <div class="p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl text-sm flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @if($classrooms->isEmpty())
                        <div class="col-span-2 bg-white p-12 text-center text-gray-400 rounded-2xl border border-gray-100">
                            មិនទាន់មានថ្នាក់រៀនត្រូវបានបង្កើតឡើយ។
                        </div>
                    @else
                        @foreach($classrooms as $class)
                            <div x-data="{ editing: false, name: '{{ $class->name }}', course_id: '{{ $class->course_id }}', teacher_name: '{{ $class->teacher_name }}', room: '{{ $class->room }}', days: '{{ $class->days }}', time_slot: '{{ $class->time_slot }}', status: '{{ $class->status }}' }" 
                                 class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                                
                                <!-- កំណែទី ១៖ បង្ហាញព័ត៌មានធម្មតា -->
                                <div x-show="!editing" class="flex flex-col justify-between h-full">
                                    <div>
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold text-lg text-gray-900">{{ $class->name }}</h4>
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ $class->status == 'active' ? 'bg-green-50 text-green-700' : 'bg-blue-50 text-blue-700' }}">{{ $class->status }}</span>
                                        </div>
                                        <p class="text-sm font-semibold text-blue-600 mb-4">{{ $class->course->name ?? 'General' }}</p>
                                        
                                        <!-- កាលវិភាគសិក្សាលម្អិត -->
                                        <div class="space-y-2 text-sm text-gray-600 mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                                            <div class="flex items-center">👨‍🏫 <span class="ml-2"><b>គ្រូ៖</b> {{ $class->teacher_name }}</span></div>
                                            <div class="flex items-center">🕒 <span class="ml-2"><b>ម៉ោង៖</b> {{ $class->time_slot }}</span></div>
                                            <div class="flex items-center">📅 <span class="ml-2"><b>ថ្ងៃ៖</b> {{ $class->days }}</span></div>
                                            <div class="flex items-center">🚪 <span class="ml-2"><b>បន្ទប់៖</b> {{ $class->room ?? '-' }}</span></div>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-50 pt-4 flex justify-end space-x-2">
                                        <button @click="editing = true" class="text-xs bg-gray-50 hover:bg-gray-100 text-gray-600 px-3.5 py-2 font-bold rounded-lg transition">
                                            {{ __('messages.edit') }}
                                        </button>
                                        <form action="{{ route('classrooms.destroy', $class->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.sure_to_delete_classroom') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-3.5 py-2 font-bold rounded-lg transition">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- កំណែទី ២៖ បង្ហាញទម្រង់កែសម្រួល Inline -->
                                <div x-show="editing" x-cloak class="w-full">
                                    <form action="{{ route('classrooms.update', $class->id) }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 mb-1">ឈ្មោះថ្នាក់រៀន</label>
                                            <input type="text" name="name" x-model="name" required class="w-full rounded-xl border-gray-200 text-sm py-2 px-3">
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 mb-1">វគ្គសិក្សា</label>
                                            <select name="course_id" x-model="course_id" required class="w-full rounded-xl border-gray-200 text-sm py-2 px-3">
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 mb-1">ឈ្មោះគ្រូបង្រៀន</label>
                                            <input type="text" name="teacher_name" x-model="teacher_name" required class="w-full rounded-xl border-gray-200 text-sm py-2 px-3">
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-xs font-bold text-gray-500 mb-1">បន្ទប់/Lab</label>
                                                <input type="text" name="room" x-model="room" class="w-full rounded-xl border-gray-200 text-sm py-2 px-3">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-gray-500 mb-1">ស្ថានភាព</label>
                                                <select name="status" x-model="status" required class="w-full rounded-xl border-gray-200 text-sm py-2 px-3">
                                                    <option value="active">Active</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 mb-1">ថ្ងៃសិក្សា</label>
                                            <input type="text" name="days" x-model="days" required class="w-full rounded-xl border-gray-200 text-sm py-2 px-3">
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 mb-1">ម៉ោងសិក្សា</label>
                                            <input type="text" name="time_slot" x-model="time_slot" required class="w-full rounded-xl border-gray-200 text-sm py-2 px-3">
                                        </div>

                                        <div class="flex space-x-2 pt-2 border-t border-gray-50">
                                            <button type="submit" class="flex-1 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg text-xs transition">
                                                រក្សាទុក
                                            </button>
                                            <button type="button" @click="editing = false; name = '{{ $class->name }}'; course_id = '{{ $class->course_id }}'; teacher_name = '{{ $class->teacher_name }}'; room = '{{ $class->room }}'; days = '{{ $class->days }}'; time_slot = '{{ $class->time_slot }}'; status = '{{ $class->status }}'" class="flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-lg text-xs transition">
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