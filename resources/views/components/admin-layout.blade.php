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
            
            /* Notification Dropdown Custom Styles */
            .notif-dropdown {
                width: 340px !important;
                z-index: 1000 !important;
            }
            .notif-header {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                background-color: #fcfbf9 !important; /* bg-earth-50 */
                border-top-left-radius: 0.75rem !important;
                border-top-right-radius: 0.75rem !important;
            }
            .notif-badge-pill {
                background-color: #e5e0d8 !important; /* bg-earth-200 */
                color: #5c5446 !important; /* text-earth-700 */
                padding: 2px 10px !important;
                border-radius: 9999px !important;
                font-size: 0.75rem !important;
                font-weight: 700 !important;
                white-space: nowrap !important;
            }
            .notif-badge-pill.new {
                background-color: #fee2e2 !important; /* bg-red-100 */
                color: #b91c1c !important; /* text-red-700 */
            }
            .notif-list {
                max-height: 320px !important;
                overflow-y: auto !important;
            }
            .notif-item {
                display: flex !important;
                align-items: flex-start !important;
                gap: 12px !important;
                padding: 16px !important;
                border-bottom: 1px solid #f3f0eb !important; /* border-earth-100 */
                text-decoration: none !important;
                transition: background-color 0.2s !important;
            }
            .notif-item:hover {
                background-color: #fcfbf9 !important; /* bg-earth-50 */
            }
            .notif-footer {
                display: block !important;
                padding: 12px !important;
                text-align: center !important;
                background-color: #ffffff !important;
                border-bottom-left-radius: 0.75rem !important;
                border-bottom-right-radius: 0.75rem !important;
            }
            .notif-footer:hover {
                background-color: #fcfbf9 !important;
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
            <header class="h-16 bg-white border-b border-earth-200 flex items-center justify-between px-8 shrink-0 z-10 shadow-sm relative">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="p-2 -ml-2 rounded-lg text-earth-500 hover:bg-earth-100 hover:text-earth-900 transition-colors focus:outline-none focus:ring-2 focus:ring-earth-200" title="Toggle Sidebar">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="font-bold text-earth-800">{{ $title ?? 'Admin Dashboard' }}</h2>
                </div>
                <div class="flex items-center gap-4 text-sm text-earth-500">
                    
                    <!-- Notification Bell -->
                    <div class="relative">
                        <button onclick="toggleNotifications(event)" class="p-2 rounded-lg text-earth-500 hover:bg-earth-100 hover:text-earth-900 transition-colors focus:outline-none relative" title="Notifikasi">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span id="notification-badge" class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white hidden"></span>
                        </button>
                        
                        <!-- Dropdown -->
                        <div id="notification-dropdown" class="notif-dropdown absolute right-0 mt-2 bg-white border border-earth-200 rounded-xl shadow-2xl hidden opacity-0 transform transition-all duration-200 origin-top-right scale-95" onclick="event.stopPropagation()">
                            <div class="p-4 border-b border-earth-100 notif-header">
                                <h3 class="font-bold text-earth-900 m-0">Notifikasi Pesanan</h3>
                                <span id="notification-count" class="notif-badge-pill">0 Baru</span>
                            </div>
                            <div id="notification-list" class="notif-list">
                                @php
                                    $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
                                @endphp
                                @forelse($recentOrders as $order)
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="notif-item">
                                        <div class="bg-green-100 p-2 rounded-full shrink-0 mt-1" style="background-color: #dcfce7; color: #16a34a;">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        </div>
                                        <div style="flex: 1; overflow: hidden;">
                                            <p class="text-sm font-bold text-earth-900 truncate m-0 leading-tight" style="color: #2b261f;">{{ $order->shipping_address['first_name'] ?? $order->user->name ?? 'Pelanggan' }}</p>
                                            <p class="text-xs mt-1 mb-0 font-medium" style="color: #5c5446;">IDR {{ number_format($order->total_amount, 2) }}</p>
                                        </div>
                                        <span class="text-xs whitespace-nowrap" style="color: #8c8273; font-size: 0.7rem;">{{ $order->created_at->diffForHumans() }}</span>
                                    </a>
                                @empty
                                    <div class="p-6 text-center text-earth-400 text-sm" id="empty-notification">Belum ada pesanan.</div>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.orders') }}" class="notif-footer border-t border-earth-100 text-sm font-bold text-earth-700 w-full block transition-colors">
                                Lihat Semua Pesanan
                            </a>
                        </div>
                    </div>

                    <span class="bg-earth-100 px-3 py-1 rounded-full font-mono text-xs border border-earth-200 ml-2 hidden sm:block">System v1.0.0</span>
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
            <!-- Toast Notification Container -->
            <div id="toast-container" class="fixed bottom-8 right-8 z-50 flex flex-col gap-3"></div>

        </div>
        
        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('admin-sidebar');
                sidebar.classList.toggle('sidebar-collapsed');
            }

            // Real-time Notification System
            let lastOrderId = {{ \App\Models\Order::max('id') ?? 0 }};
            let unreadCount = 0;
            
            function toggleNotifications(event) {
                if (event) {
                    event.stopPropagation();
                }
                const dropdown = document.getElementById('notification-dropdown');
                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                    // Reset unread count when opened
                    unreadCount = 0;
                    updateBadge();
                    setTimeout(() => {
                        dropdown.classList.remove('opacity-0', 'scale-95');
                    }, 10);
                } else {
                    dropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        dropdown.classList.add('hidden');
                    }, 200);
                }
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('notification-dropdown');
                if (!dropdown.classList.contains('hidden') && !event.target.closest('.relative')) {
                    toggleNotifications();
                }
            });

            function updateBadge() {
                const badge = document.getElementById('notification-badge');
                const countBadge = document.getElementById('notification-count');
                
                if (unreadCount > 0) {
                    badge.classList.remove('hidden');
                    countBadge.textContent = unreadCount + ' Baru';
                    countBadge.classList.add('new');
                } else {
                    badge.classList.add('hidden');
                    countBadge.textContent = '0 Baru';
                    countBadge.classList.remove('new');
                }
            }
            
            function addNotificationToList(order) {
                const list = document.getElementById('notification-list');
                const emptyMsg = document.getElementById('empty-notification');
                
                if (emptyMsg) {
                    emptyMsg.remove();
                }
                
                const item = document.createElement('a');
                item.href = `/admin/orders/${order.id}/edit`;
                item.className = 'notif-item animate-fade-in';
                item.innerHTML = `
                    <div class="bg-green-100 p-2 rounded-full shrink-0 mt-1" style="background-color: #dcfce7; color: #16a34a;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div style="flex: 1; overflow: hidden;">
                        <p class="text-sm font-bold text-earth-900 truncate m-0 leading-tight" style="color: #2b261f;">${order.customer_name}</p>
                        <p class="text-xs mt-1 mb-0 font-medium" style="color: #5c5446;">IDR ${order.total_amount}</p>
                    </div>
                    <span class="text-xs whitespace-nowrap" style="color: #8c8273; font-size: 0.7rem;">Baru saja</span>
                `;
                
                list.insertBefore(item, list.firstChild);
            }

            function showToast(title, message) {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = 'bg-white border-l-4 border-green-500 shadow-2xl rounded-lg p-4 flex items-start gap-4 transform transition-all duration-500 translate-y-10 opacity-0';
                
                toast.innerHTML = `
                    <div class="bg-green-100 p-2 rounded-full shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-gray-900">${title}</h4>
                        <p class="text-sm text-gray-600 mt-1">${message}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                `;
                
                container.appendChild(toast);
                
                // Animate in
                setTimeout(() => {
                    toast.classList.remove('translate-y-10', 'opacity-0');
                }, 10);
                
                // Auto remove after 6 seconds
                setTimeout(() => {
                    toast.classList.add('opacity-0', 'translate-x-10');
                    setTimeout(() => toast.remove(), 500);
                }, 6000);
            }

            function pollNewOrders() {
                fetch(`/admin/api/check-new-orders?last_id=${lastOrderId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.has_new && data.orders.length > 0) {
                            data.orders.forEach(order => {
                                showToast(
                                    'Pesanan Baru Masuk!',
                                    `Dari: <strong>${order.customer_name}</strong><br>Total: IDR ${order.total_amount}`
                                );
                                
                                addNotificationToList(order);
                                unreadCount++;
                                updateBadge();
                                
                                // Update last ID
                                if (order.id > lastOrderId) {
                                    lastOrderId = order.id;
                                }
                            });
                        }
                    })
                    .catch(error => console.error('Error polling new orders:', error));
            }

            // Check every 10 seconds
            setInterval(pollNewOrders, 10000);
        </script>
    </body>
</html>
