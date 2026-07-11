<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Jepara Wood-Trace | Authentic 3D Relief Art' }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Google Model Viewer for AR -->
        <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    </head>
    <body class="bg-earth-100 text-earth-800 font-sans antialiased selection:bg-earth-500 selection:text-white">
        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <header class="w-full py-6 px-8 flex justify-between items-center border-b border-earth-200 bg-earth-100/80 backdrop-blur-md sticky top-0 z-50">
                <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-earth-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-earth-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Jepara<span class="font-normal text-earth-500">WoodTrace</span>
                </a>
                <nav class="hidden md:flex items-center gap-8 font-medium text-earth-800">
                    <a href="{{ route('gallery.index') }}" class="hover:text-earth-500 transition">Gallery</a>
                    <a href="{{ route('pages.artisans') }}" class="hover:text-earth-500 transition">Artisans</a>
                    <a href="{{ route('pages.svlk') }}" class="hover:text-earth-500 transition">SVLK Check</a>
                    <a href="{{ route('pages.about') }}" class="hover:text-earth-500 transition">About</a>
                    <a href="{{ route('orders.history') }}" class="hover:text-earth-500 transition">Pesanan Saya</a>
                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="border-l border-earth-200 pl-8 {{ Request::is('admin*') ? 'text-earth-900 font-bold' : 'hover:text-earth-500 transition' }}">Admin Dashboard</a>
                        @endif
                    @endauth
                </nav>
                <div class="flex items-center space-x-4">
                    <!-- Language Switcher -->
                    <div class="flex items-center space-x-2 border-r border-earth-200 pr-4 mr-2">
                        <a href="{{ route('lang.switch', 'en') }}" class="text-sm font-medium {{ app()->getLocale() == 'en' ? 'text-earth-800' : 'text-earth-500 hover:text-earth-800' }}">EN</a>
                        <span class="text-earth-500">|</span>
                        <a href="{{ route('lang.switch', 'id') }}" class="text-sm font-medium {{ app()->getLocale() == 'id' ? 'text-earth-800' : 'text-earth-500 hover:text-earth-800' }}">ID</a>
                    </div>
                    @auth
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-bold text-earth-800 whitespace-nowrap">Hi, {{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-earth-500 hover:text-red-500 transition duration-300">Log out</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-earth-500 transition duration-300">{{ __('messages.log_in') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-medium bg-earth-800 text-earth-100 px-5 py-2.5 rounded hover:bg-earth-900 transition duration-300">{{ __('messages.register') }}</a>
                        @endif
                    @endauth
                </div>
            </header>

            <!-- Main Content -->
            <main class="grow relative">
                <!-- Toast Flash Messages -->
                @if(session('success'))
                    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8 z-30 relative animate-fade-in">
                        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl shadow-sm flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="font-medium">{{ session('success') }}</span>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-900 text-2xl leading-none">&times;</button>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8 z-30 relative animate-fade-in">
                        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl shadow-sm flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <span class="font-medium">{{ session('error') }}</span>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-900 text-2xl leading-none">&times;</button>
                        </div>
                    </div>
                @endif

                <!-- Background decorative elements -->
                <div class="fixed top-[-10%] left-[-10%] w-96 h-96 bg-earth-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none z-0"></div>
                <div class="fixed bottom-[-10%] right-[-5%] w-96 h-96 bg-earth-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 pointer-events-none z-0"></div>

                <div class="relative z-10 w-full">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-10 text-center text-sm text-earth-500 border-t border-earth-200 bg-white relative z-10">
                <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
                    <p>&copy; {{ date('Y') }} Jepara Wood-Trace. All rights reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-earth-800 transition">{{ __('messages.privacy_policy') }}</a>
                        <a href="#" class="hover:text-earth-800 transition">{{ __('messages.terms_of_service') }}</a>
                        <a href="#" class="hover:text-earth-800 transition">{{ __('messages.contact') }}</a>
                    </div>
                </div>
            </footer>
        </div>
        @stack('modals')
    </body>
</html>
