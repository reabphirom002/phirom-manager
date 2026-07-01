<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.dashboard') }}
            </h2>
            <span class="text-sm text-gray-500">{{ __('messages.logged_in_as') }} <strong class="text-blue-600">{{ Auth::user()->name }}</strong></span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- សារស្វាគមន៍ (Welcome Banner) -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 text-white shadow-lg">
                <h3 class="text-2xl sm:text-3xl font-bold mb-2">{{ __('messages.welcome_back') }}, {{ Auth::user()->name }}!</h3>
                <p class="text-blue-100">នេះជាផ្ទាំងបញ្ជាកណ្ដាលរបស់ក្រុមហ៊ុន PHIROM MANAGER សម្រាប់គ្រប់គ្រងប្រតិបត្តិការប្រចាំថ្ងៃរបស់ហាង និងសាលារៀន។</p>
            </div>

            <!-- ផ្នែកស្ថិតិសង្ខេប (Quick Statistics Overview) -->
            <div>
                <h4 class="text-lg font-semibold text-gray-800 mb-4">{{ __('messages.quick_stats') }}</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- ការលក់សរុប -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="text-sm text-gray-500 font-medium block mb-1">{{ __('messages.total_sales') }}</span>
                            <span class="text-2xl font-bold text-gray-900">$0.00</span>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>

                    <!-- សិស្សសរុប -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="text-sm text-gray-500 font-medium block mb-1">{{ __('messages.total_students') }}</span>
                            <span class="text-2xl font-bold text-gray-900">0</span>
                        </div>
                        <div class="p-3 rounded-lg bg-green-50 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                        </div>
                    </div>

                    <!-- ឯកសារសរុប -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <span class="text-sm text-gray-500 font-medium block mb-1">{{ __('messages.total_documents') }}</span>
                            <span class="text-2xl font-bold text-gray-900">0</span>
                        </div>
                        <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ផ្នែកច្រកចូលទៅកាន់ការគ្រប់គ្រងស្ថាប័នទាំង ៣ (Core Business Control Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- ១. គ្រប់គ្រងហាងកុំព្យូទ័រ -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h5 class="font-bold text-lg text-gray-800 mb-1">{{ __('messages.comp_shop_title') }}</h5>
                        <p class="text-sm text-gray-500 mb-4">គ្រប់គ្រងស្ដុកទំនិញ ផលិតផល និងប្រព័ន្ធលក់កុំព្យូទ័រ។</p>
                    </div>
                    <a href="#" class="w-full text-center py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition">{{ __('messages.manage_now') }}</a>
                </div>

                <!-- ២. គ្រប់គ្រងសាលាបង្រៀនកុំព្យូទ័រ -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="w-10 h-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                        </div>
                        <h5 class="font-bold text-lg text-gray-800 mb-1">{{ __('messages.school_title') }}</h5>
                        <p class="text-sm text-gray-500 mb-4">គ្រប់គ្រងការចុះឈ្មោះសិក្សា ថ្នាក់រៀន និងកាលវិភាគ។</p>
                    </div>
                    <a href="#" class="w-full text-center py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm transition">{{ __('messages.manage_now') }}</a>
                </div>

                <!-- ៣. គ្រប់គ្រងហាងកាហ្វេ -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h5 class="font-bold text-lg text-gray-800 mb-1">{{ __('messages.coffee_title') }}</h5>
                        <p class="text-sm text-gray-500 mb-4">គ្រប់គ្រងម៉ឺនុយភេសជ្ជៈ ការលក់ និងគិតប្រាក់រហ័ស។</p>
                    </div>
                    <a href="#" class="w-full text-center py-2 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg text-sm transition">{{ __('messages.manage_now') }}</a>
                </div>

                <!-- ៤. គ្រប់គ្រងឯកសារ និងមេរៀន -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                        </div>
                        <h5 class="font-bold text-lg text-gray-800 mb-1">{{ __('messages.library_title') }}</h5>
                        <p class="text-sm text-gray-500 mb-4">គ្រប់គ្រងការអាប់ឡូតមេរៀន PDF, Word និងលីងយូធូប។</p>
                    </div>
                    <a href="{{ route('lessons.index') }}" class="w-full text-center py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-sm transition">{{ __('messages.manage_now') }}</a>   
                </div>
            </div>

        </div>
    </div>
</x-app-layout>