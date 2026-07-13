<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHIROM COMPUTER - ហាងលក់កុំព្យូទ័រ និងគ្រឿងបន្លាស់</title>
    
    <!-- Google Fonts: Kantumruy Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 antialiased min-h-screen flex flex-col justify-between">

    <!-- ១. របារម៉ឺនុយខាងលើ (Navigation Bar) -->
    <header class="bg-slate-900/80 border-b border-slate-800 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center space-x-3">
                <img class="h-10 w-10 rounded-full object-cover border-2 border-blue-500 shadow-lg" src="{{ asset('images/logo.png') }}" alt="Logo">
                <span class="text-xl font-bold tracking-wider bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">PHIROM COMPUTER</span>
            </a>

            <!-- ប៊ូតុងត្រឡប់ ឬ Login -->
            <div class="flex items-center space-x-4">
                <a href="/" class="text-sm font-semibold text-slate-400 hover:text-white transition">&larr; ត្រឡប់ទៅទំព័រដើម</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 transition">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-400 hover:text-white transition">ចូលប្រើប្រាស់</a>
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <main class="flex-grow py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- ២. ក្បាលទំព័រ និងប្រអប់ស្វែងរក (Header & Search Bar) -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 border-b border-slate-800 pb-8">
            <div class="text-center md:text-left space-y-2">
                <h1 class="text-3xl font-bold tracking-wide">🛍️ ហាងកុំព្យូទ័រ PHIROM COMPUTER</h1>
                <p class="text-slate-400 text-sm">កុំព្យូទ័រលំដាប់ថវិកា និងអាជីព នាំចូលថ្មីៗបំផុតសម្រាប់លោកអ្នក</p>
            </div>

            <!-- ប្រអប់ស្វែងរក (Search Form) -->
            <form method="GET" action="{{ route('public.computers') }}" class="w-full md:w-96 flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="ស្វែងរកកុំព្យូទ័រ ឬម៉ាក..." class="w-full bg-slate-800/60 border-slate-700 text-white rounded-l-xl focus:border-blue-500 py-3 px-4 shadow-sm text-sm focus:ring-0">
                <button type="submit" class="px-5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-r-xl transition text-sm">
                    ស្វែងរក
                </button>
            </form>
        </div>

        <!-- ៣. តារាងបង្ហាញកុំព្យូទ័រ (Product Catalog Grid) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($products as $p)
                <div class="bg-slate-800/40 border border-slate-800 hover:border-blue-500/40 rounded-3xl overflow-hidden flex flex-col justify-between hover:-translate-y-1 transition duration-300">
                    <div>
                        <!-- រូបភាពកុំព្យូទ័រ -->
                        <div class="h-48 bg-slate-800/20 flex items-center justify-center relative">
                            @if ($p->image_url)
                                <img src="{{ asset($p->image_url) }}" class="h-full w-full object-cover" alt="{{ $p->name }}">
                            @else
                                <span class="text-6xl">💻</span>
                            @endif
                            <span class="absolute top-4 left-4 px-2.5 py-0.5 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-md text-xs font-bold uppercase tracking-wider">{{ $p->brand }}</span>
                        </div>

                        <!-- ព័ត៌មានលម្អិត -->
                        <div class="p-6 space-y-3">
                            <h3 class="font-bold text-white text-base line-clamp-1">{{ $p->name }}</h3>
                            <p class="text-slate-400 text-xs line-clamp-2 h-10 leading-relaxed">{{ $p->specs ?? 'គ្មានព័ត៌មានលម្អិតបច្ចេកទេស' }}</p>
                        </div>
                    </div>

                    <!-- តម្លៃ និងស្តុក -->
                    <div class="p-6 pt-0 flex justify-between items-center border-t border-slate-800/60 mt-4">
                        <span class="text-lg font-black text-blue-400">${{ number_format($p->selling_price, 2) }}</span>
                        @if ($p->qty > 0)
                            <span class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-1 rounded-full">មានក្នុងស្តុក ({{ $p->qty }} គ្រឿង)</span>
                        @else
                            <span class="text-xs font-semibold text-red-400 bg-red-500/10 border border-red-500/20 px-2.5 py-1 rounded-full">អស់ពីស្តុក</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-slate-500 bg-slate-800/10 border border-slate-800/60 rounded-3xl">
                    <span class="text-5xl block mb-3">📦</span>
                    <p class="text-sm font-semibold">មិនមានកុំព្យូទ័រដែលលោកអ្នកចង់ស្វែងរកឡើយបាទ</p>
                </div>
            @endforelse
        </div>

        <!-- ៤. ប៊ូតុងប្ដូរទំព័រ (Pagination Links) -->
        <div class="pt-6">
            {{ $products->appends(request()->query())->links() }}
        </div>

    </main>

    <!-- ៥. Footer ផ្នែកខាងក្រោមបង្អស់ -->
    <footer class="border-t border-slate-800 py-8 px-4 text-center text-sm text-slate-500">
        <p>{{ __('messages.copyright') }}</p>
    </footer>

</body>
</html>