<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Merchant')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <aside class="w-64 bg-white shadow-lg flex flex-col">
            <div class="h-16 flex items-center justify-center border-b font-bold text-xl text-indigo-600">
                Merchant
            </div>

            <nav class="flex-1 p-4 space-y-2">

                <a href="{{ route('merchant.dashboard') }}"
                    class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('merchant.dashboard') ? 'bg-indigo-100 text-indigo-600 font-semibold' : 'hover:bg-gray-100' }}">
                    Dashboard
                </a>

                <a href="{{ route('merchant.orders.index') }}"
                    class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('merchant.orders.*') ? 'bg-indigo-100 text-indigo-600 font-semibold' : 'hover:bg-gray-100' }}">
                    Pesanan Masuk
                </a>

                <a href="{{ route('merchant.menus.index') }}"
                    class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('merchant.menus.*') ? 'bg-indigo-100 text-indigo-600 font-semibold' : 'hover:bg-gray-100' }}">
                    Menu Saya
                </a>

            </nav>

            <div class="p-4 border-t text-xs text-gray-400 text-center">
                © {{ date('Y') }} Catering
            </div>
        </aside>


        <div class="flex-1 flex flex-col">

            <header class="h-16 bg-white shadow flex items-center justify-between px-6 relative">

                <h1 class="text-lg font-semibold text-gray-700">
                    @yield('header', 'Dashboard Merchant')
                </h1>

                <div class="relative">

                    <button id="profileButton"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-100 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-400">

                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white flex items-center justify-center text-sm font-semibold shadow">
                            {{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 1)) }}
                        </div>

                        <div class="text-left hidden md:block">
                            <div class="text-sm font-semibold text-gray-800 leading-tight">
                                {{ auth()->user()->name ?? '' }}
                            </div>
                            <div class="text-xs text-indigo-500 font-medium">
                                Merchant
                            </div>
                        </div>

                        <svg id="arrowIcon" class="w-4 h-4 text-gray-500 transition-transform duration-200" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="profileDropdown" class="absolute right-0 mt-3 w-56 bg-white border border-gray-100 rounded-2xl shadow-xl py-3
                   opacity-0 scale-95 invisible
                   transition-all duration-200 z-50">

                        <div class="px-4 pb-3 border-b">
                            <div class="text-sm font-semibold text-gray-800">
                                {{ auth()->user()->name ?? '' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ auth()->user()->email ?? '' }}
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                            👤 Profile
                        </a>

                        <div class="border-t my-2"></div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                🚪 Logout
                            </button>
                        </form>

                    </div>
                </div>

            </header>
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>

            <footer class="h-12 bg-white border-t flex items-center justify-center text-sm text-gray-500">
                Merchant Catering
            </footer>

        </div>

    </div>

</body>

</html>