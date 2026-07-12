<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Admin Panel | Jepara Wood-Trace' }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* Mini Sidebar Transitions */
            #admin-sidebar {
                transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                overflow-x: hidden;
            }
            .sidebar-collapsed {
                width: 88px !important;
            }
            .sidebar-collapsed .sidebar-text {
                opacity: 0;
                width: 0;
                height: 0;
                overflow: hidden;
                display: none;
            }
            .sidebar-collapsed .nav-link {
                justify-content: center !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                position: relative;
            }
            .sidebar-collapsed .active-dot {
                position: absolute;
                right: 8px;
                top: 50%;
                transform: translateY(-50%);
                margin: 0 !important;
            }
            .sidebar-collapsed .sidebar-header {
                padding-left: 0 !important;
                padding-right: 0 !important;
                justify-content: center !important;
            }
            .sidebar-collapsed .profile-card {
                padding: 12px 8px !important;
            }
            .sidebar-collapsed .profile-avatar-container {
                margin: 0 auto !important;
                justify-content: center !important;
            }
            .sidebar-collapsed .logout-btn {
                gap: 0 !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            .sidebar-collapsed .logout-btn svg {
                margin: 0 auto;
            }
        </style>
    </head>
    <body class="bg-earth-50 text-earth-800 font-sans antialiased flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside id="admin-sidebar" class="w-72 bg-linear-to-b from-earth-900 to-black text-earth-100 flex flex-col h-full shrink-0 shadow-2xl relative z-20">
            <!-- Decorative background element in sidebar -->
            <div class="absolute top-0 left-0 w-full h-64 bg-white opacity-5 mix-blend-overlay pointer-events-none rounded-br-[100px]"></div>

            <div class="p-8 relative z-10">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-black tracking-tight text-white flex items-center gap-3 sidebar-header">
                    <div class="w-10 h-10 bg-linear-to-br from-earth-400 to-earth-600 rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-earth-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div class="leading-tight sidebar-text">
                        JWT<br><span class="font-normal text-earth-400 text-sm">Admin Panel</span>
                    </div>
                </a>
            </div>
            
            <nav class="flex-1 px-6 space-y-8 overflow-y-auto relative z-10 pb-8 mt-2">
                <div>
                    <div class="text-xs font-bold text-earth-500 uppercase tracking-wider mb-4 px-2 sidebar-text">Menu Utama</div>
                    <div class="space-y-1.5">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.dashboard') ? 'bg-white/10 text-white shadow-inner border border-white/5' : 'text-earth-400 hover:text-white hover:bg-white/5 hover:translate-x-1' }}">
                            <div class="shrink-0 {{ Request::routeIs('admin.dashboard') ? 'text-earth-300' : 'text-earth-500 group-hover:text-earth-300' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <span class="font-medium sidebar-text">Dashboard</span>
                            @if(Request::routeIs('admin.dashboard'))
                                <div class="ml-auto w-1.5 h-1.5 rounded-full bg-earth-300 shadow-[0_0_8px_rgba(255,255,255,0.5)] active-dot"></div>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.orders') }}" class="nav-link group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.orders') || Request::routeIs('admin.orders.*') ? 'bg-white/10 text-white shadow-inner border border-white/5' : 'text-earth-400 hover:text-white hover:bg-white/5 hover:translate-x-1' }}">
                            <div class="shrink-0 {{ Request::routeIs('admin.orders') || Request::routeIs('admin.orders.*') ? 'text-earth-300' : 'text-earth-500 group-hover:text-earth-300' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <span class="font-medium sidebar-text">Pesanan</span>
                            @if(Request::routeIs('admin.orders') || Request::routeIs('admin.orders.*'))
                                <div class="ml-auto w-1.5 h-1.5 rounded-full bg-earth-300 shadow-[0_0_8px_rgba(255,255,255,0.5)] active-dot"></div>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.products.create') }}" class="nav-link group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.products.create') || Request::routeIs('admin.products.edit') ? 'bg-white/10 text-white shadow-inner border border-white/5' : 'text-earth-400 hover:text-white hover:bg-white/5 hover:translate-x-1' }}">
                            <div class="shrink-0 {{ Request::routeIs('admin.products.create') || Request::routeIs('admin.products.edit') ? 'text-earth-300' : 'text-earth-500 group-hover:text-earth-300' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                            <span class="font-medium sidebar-text">Tambah Produk</span>
                            @if(Request::routeIs('admin.products.create') || Request::routeIs('admin.products.edit'))
                                <div class="ml-auto w-1.5 h-1.5 rounded-full bg-earth-300 shadow-[0_0_8px_rgba(255,255,255,0.5)] active-dot"></div>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.users.index') }}" class="nav-link group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 {{ Request::routeIs('admin.users.*') ? 'bg-white/10 text-white shadow-inner border border-white/5' : 'text-earth-400 hover:text-white hover:bg-white/5 hover:translate-x-1' }}">
                            <div class="shrink-0 {{ Request::routeIs('admin.users.*') ? 'text-earth-300' : 'text-earth-500 group-hover:text-earth-300' }} transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <span class="font-medium sidebar-text">Kelola Pengguna</span>
                            @if(Request::routeIs('admin.users.*'))
                                <div class="ml-auto w-1.5 h-1.5 rounded-full bg-earth-300 shadow-[0_0_8px_rgba(255,255,255,0.5)] active-dot"></div>
                            @endif
                        </a>
                    </div>
                </div>

                <div>
                    <div class="text-xs font-bold text-earth-500 uppercase tracking-wider mb-4 px-2 sidebar-text">Sistem</div>
                    <div class="space-y-1.5">
                        <a href="{{ route('home') }}" class="nav-link group flex items-center gap-3 px-4 py-3 rounded-2xl text-earth-400 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all duration-200">
                            <div class="shrink-0 text-earth-500 group-hover:text-earth-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            </div>
                            <span class="font-medium sidebar-text">Lihat Web Utama</span>
                        </a>
                    </div>
                </div>
            </nav>
            
            <div class="p-6 relative z-10">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-md profile-card">
                    <div class="flex items-center gap-3 mb-4 profile-avatar-container">
                        <div class="shrink-0 w-10 h-10 rounded-full bg-linear-to-r from-earth-400 to-earth-600 flex items-center justify-center font-bold text-white shadow-inner">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="flex-1 overflow-hidden sidebar-text">
                            <div class="font-bold text-white text-sm truncate">{{ Auth::user()->name ?? 'Admin' }}</div>
                            <div class="text-xs text-earth-400 truncate">Administrator</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="logout-btn w-full py-2.5 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/20 hover:border-red-500 rounded-xl text-sm font-bold transition-all duration-300 flex items-center justify-center gap-2 group">
                            <svg class="shrink-0 w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="sidebar-text">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-full overflow-hidden bg-earth-50 relative">
            
            <!-- Top Header -->
            <header class="h-16 bg-white border-b border-earth-200 flex items-center justify-between px-8 shrink-0 z-10 shadow-sm">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="p-2 -ml-2 rounded-lg text-earth-500 hover:bg-earth-100 hover:text-earth-900 transition-colors focus:outline-none focus:ring-2 focus:ring-earth-200" title="Toggle Sidebar">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="font-bold text-earth-800">{{ $title ?? 'Admin Dashboard' }}</h2>
                </div>
                <div class="flex items-center gap-4 text-sm text-earth-500">
                    <span class="bg-earth-100 px-3 py-1 rounded-full font-mono text-xs border border-earth-200">System v1.0.0</span>
                </div>
            </header>

            <!-- Scrollable Page Content -->
            <main class="flex-1 overflow-y-auto p-8 relative">
                
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 animate-fade-in">
                        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl shadow-sm flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="font-medium">{{ session('success') }}</span>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-900 leading-none">&times;</button>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 animate-fade-in">
                        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl shadow-sm flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <span class="font-medium">{{ session('error') }}</span>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-900 leading-none">&times;</button>
                        </div>
                    </div>
                @endif

                {{ $slot }}
                
            </main>
        </div>
        
        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('admin-sidebar');
                sidebar.classList.toggle('sidebar-collapsed');
            }
        </script>
    </body>
</html>
