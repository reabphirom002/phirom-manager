<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.dashboard') }}
            </h2>
            <span class="text-sm text-gray-500 font-medium">PHIROM MANAGER &bull; Control Panel</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- ១. ផ្ទាំងស្វាគមន៍បែបប្រណីត -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-700 rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-white/10 blur-xl"></div>
                <div class="absolute -left-10 -bottom-10 w-40 h-40 rounded-full bg-white/10 blur-xl"></div>
                
                <div class="relative z-10 max-w-2xl">
                    <span class="px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider bg-white/20 rounded-full border border-white/20 mb-4 inline-block">{{ __('messages.dashboard') }}</span>
                    <h3 class="text-3xl sm:text-4xl font-bold mb-3 tracking-wide leading-tight">
                        {{ __('messages.welcome_back') }}, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                        {{ __('messages.welcome_back_subtitle') }}
                    </p>
                </div>
            </div>

            <!-- ២. ប៊ូតុងបញ្ជាសកម្មភាពរហ័ស (Quick Actions) -->
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">{{ __('messages.quick_actions') }}</h4>
                <div class="flex flex-wrap gap-3">
                    <!-- បន្ថែមកុំព្យូទ័ររហ័ស -->
                    <a href="{{ route('products.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold rounded-xl text-xs transition duration-150 shadow-sm">
                        <span>{{ __('messages.quick_add_product') }}</span>
                    </a>
                    <!-- ចុះឈ្មោះសិស្សរហ័ស -->
                    <a href="{{ route('students.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-green-50 hover:bg-green-100 text-green-700 font-semibold rounded-xl text-xs transition duration-150 shadow-sm">
                        <span>{{ __('messages.quick_add_student') }}</span>
                    </a>
                    <!-- បង្កើតថ្នាក់រៀនរហ័ស -->
                    <a href="{{ route('classrooms.index') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-purple-50 hover:bg-purple-100 text-purple-700 font-semibold rounded-xl text-xs transition duration-150 shadow-sm">
                        <span>{{ __('messages.quick_add_classroom') }}</span>
                    </a>
                    <!-- បន្ថែមភេសជ្ជៈរហ័ស -->
                    <a href="{{ route('beverages.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold rounded-xl text-xs transition duration-150 shadow-sm">
                        <span>{{ __('messages.quick_add_beverage') }}</span>
                    </a>
                    <!-- បង្ហោះមេរៀនរហ័ស -->
                    <a href="{{ route('lessons.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-pink-50 hover:bg-pink-100 text-pink-700 font-semibold rounded-xl text-xs transition duration-150 shadow-sm">
                        <span>{{ __('messages.quick_upload_lesson') }}</span>
                    </a>
                </div>
            </div>

            <!-- ៣. ផ្នែកស្ថិតិសង្ខេបប្រចាំក្រុមហ៊ុន -->
            <div>
                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">{{ __('messages.quick_stats') }}</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- ការលក់សរុប -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase tracking-wider block mb-1">{{ __('messages.total_sales') }}</span>
                            <span class="text-2xl font-bold text-gray-900">$ {{ number_format(\App\Models\Product::sum(\Illuminate\Support\Facades\DB::raw('qty * selling_price')), 2) }}</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-blue-50 text-blue-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>

                    <!-- សិស្សសរុប -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase tracking-wider block mb-1">{{ __('messages.total_students') }}</span>
                            <span class="text-2xl font-bold text-gray-900">{{ \App\Models\Student::count() }} នាក់</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-green-50 text-green-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                        </div>
                    </div>

                    <!-- ភេសជ្ជៈសរុប -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
                        <div>
                            <span class="text-xs text-gray-400 font-bold uppercase tracking-wider block mb-1">{{ __('messages.total_beverages') }}</span>
                            <span class="text-2xl font-bold text-gray-900">{{ \App\Models\Beverage::count() }} មុខ</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-amber-50 text-amber-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ៤. ផ្ទាំងច្រកចូលទៅកាន់ការគ្រប់គ្រងស្ថាប័នទាំង ៤ (Premium Business Hub) -->
            <div>
                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">{{ __('messages.business_hub') }}</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- ១. គ្រប់គ្រងហាងកុំព្យូទ័រ -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-lg hover:-translate-y-1 transition duration-200">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mb-4 text-lg">📦</div>
                            <h5 class="font-bold text-lg text-gray-900 mb-1">{{ __('messages.computer_shop') }}</h5>
                            <p class="text-xs text-gray-500 mb-6 leading-relaxed">{{ __('messages.shop_hub_desc') }}</p>
                        </div>
                        <a href="{{ route('products.index') }}" class="w-full text-center py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs transition shadow-sm">{{ __('messages.manage_now') }}</a>
                    </div>

                    <!-- ២. គ្រប់គ្រងសាលាបង្រៀនកុំព្យូទ័រ -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-lg hover:-translate-y-1 transition duration-200">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center mb-4 text-lg">👨‍🎓</div>
                            <h5 class="font-bold text-lg text-gray-900 mb-1">{{ __('messages.school_title') }}</h5>
                            <p class="text-xs text-gray-500 mb-6 leading-relaxed">{{ __('messages.school_hub_desc') }}</p>
                        </div>
                        <a href="{{ route('students.index') }}" class="w-full text-center py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl text-xs transition shadow-sm">{{ __('messages.manage_now') }}</a>
                    </div>

                    <!-- ៣. គ្រប់គ្រងហាងកាហ្វេ -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-lg hover:-translate-y-1 transition duration-200">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center mb-4 text-lg">🍹</div>
                            <h5 class="font-bold text-lg text-gray-900 mb-1">{{ __('messages.coffee_shop') }}</h5>
                            <p class="text-xs text-gray-500 mb-6 leading-relaxed">{{ __('messages.coffee_hub_desc') }}</p>
                        </div>
                        <a href="{{ route('beverages.index') }}" class="w-full text-center py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl text-xs transition shadow-sm">{{ __('messages.manage_now') }}</a>
                    </div>

                    <!-- ៤. គ្រប់គ្រងឯកសារ និងមេរៀន -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-lg hover:-translate-y-1 transition duration-200">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center mb-4 text-lg">📄</div>
                            <h5 class="font-bold text-lg text-gray-900 mb-1">{{ __('messages.library_title') }}</h5>
                            <p class="text-xs text-gray-500 mb-6 leading-relaxed">{{ __('messages.library_hub_desc') }}</p>
                        </div>
                        <a href="{{ route('lessons.index') }}" class="w-full text-center py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl text-xs transition shadow-sm">{{ __('messages.manage_now') }}</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>