<x-admin-layout>
    <x-slot:title>Admin Dashboard | Jepara Wood-Trace</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-earth-900">Dashboard Admin</h1>
                <p class="text-earth-600 mt-1">Kelola data produk, seniman, dan pantau stok.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="px-5 py-3 bg-earth-900 text-earth-100 font-bold rounded-lg hover:bg-black transition shadow-lg transform hover:-translate-y-1">
                + Tambah Produk Baru
            </a>
        </div>

        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white rounded-2xl p-6 border border-earth-200 shadow-sm flex flex-col justify-between">
                <div class="text-earth-500 text-sm font-medium mb-1">Total Produk</div>
                <div class="text-3xl font-bold text-earth-900">{{ $totalProducts }}</div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-earth-200 shadow-sm flex flex-col justify-between">
                <div class="text-earth-500 text-sm font-medium mb-1">Total Seniman</div>
                <div class="text-3xl font-bold text-earth-900">{{ $totalArtists }}</div>
            </div>
            <a href="{{ route('admin.orders') }}" class="bg-white rounded-2xl p-6 border border-earth-200 shadow-sm flex flex-col justify-between hover:shadow-md transition group">
                <div class="text-earth-500 text-sm font-medium mb-1 group-hover:text-earth-900 transition">Total Pesanan (Lihat Detail)</div>
                <div class="text-3xl font-bold text-earth-900">{{ $totalOrders }}</div>
            </a>
            <div class="bg-white rounded-2xl p-6 border border-earth-200 shadow-sm flex flex-col justify-between relative overflow-hidden">
                <div class="text-red-500 text-sm font-medium mb-1">Stok Habis (Kosong)</div>
                <div class="text-3xl font-bold text-red-600">{{ $outOfStock }}</div>
                @if($outOfStock > 0)
                    <div class="absolute top-0 right-0 w-16 h-16 bg-red-100 rounded-bl-full -mr-8 -mt-8"></div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-earth-200 shadow-xl overflow-hidden">
            <div class="p-6 border-b border-earth-200 bg-earth-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
                <h2 class="text-xl font-bold text-earth-800">Manajemen Produk</h2>
                <div class="relative w-full sm:w-auto">
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-earth-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Cari produk..." class="pl-10 pr-4 py-2 border border-earth-200 rounded-lg text-sm w-full sm:w-64 focus:ring-2 focus:ring-earth-500 focus:outline-none bg-white">
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-earth-200 text-earth-500 bg-earth-50 text-sm">
                            <th class="p-4 font-semibold uppercase tracking-wider">Produk</th>
                            <th class="p-4 font-semibold uppercase tracking-wider">Harga</th>
                            <th class="p-4 font-semibold uppercase tracking-wider text-center">Stok</th>
                            <th class="p-4 font-semibold uppercase tracking-wider">Kategori / SVLK</th>
                            <th class="p-4 font-semibold text-center uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-earth-800 text-sm">
                        @forelse($products as $product)
                            <tr class="border-b border-earth-100 last:border-0 hover:bg-earth-50/80 transition">
                                <td class="p-4 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-earth-200 rounded overflow-hidden shrink-0 border border-earth-200">
                                        @php
                                            $imageUrl = null;
                                            if(is_array($product->images) && count($product->images) > 0) {
                                                $imageUrl = asset('images/products/' . $product->images[0]);
                                            } elseif(file_exists(public_path('images/products/' . $product->id . '.jpg'))) {
                                                $imageUrl = asset('images/products/' . $product->id . '.jpg');
                                            }
                                        @endphp
                                        @if($imageUrl)
                                            <img src="{{ $imageUrl }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-earth-400">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-earth-900 line-clamp-1" title="{{ $product->title }}">{{ $product->title }}</div>
                                        <div class="text-xs text-earth-500 mt-0.5">ID: #{{ $product->id }} | Seniman: {{ $product->artist->name ?? 'N/A' }}</div>
                                    </div>
                                </td>
                                <td class="p-4 font-medium text-earth-700">IDR {{ number_format($product->price, 0) }}</td>
                                <td class="p-4 text-center">
                                    @if($product->stock > 10)
                                        <span class="bg-green-100 text-green-800 px-2.5 py-1 rounded-md text-xs font-bold">{{ $product->stock }}</span>
                                    @elseif($product->stock > 0)
                                        <span class="bg-yellow-100 text-yellow-800 px-2.5 py-1 rounded-md text-xs font-bold">{{ $product->stock }}</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-2.5 py-1 rounded-md text-xs font-bold">Habis</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-col items-start gap-1">
                                        <span class="bg-earth-200/50 border border-earth-200 px-2 py-0.5 rounded text-[10px] font-bold text-earth-700 uppercase tracking-wide">
                                            {{ $product->category ?? 'Kayu' }}
                                        </span>
                                        @if($product->svlk_certificate_number)
                                            <span class="font-mono text-[10px] text-earth-600 bg-earth-50 border border-earth-100 px-1.5 py-0.5 rounded" title="SVLK Number">
                                                {{ $product->svlk_certificate_number }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1.5 bg-earth-100 text-earth-800 border border-earth-200 rounded hover:bg-earth-200 font-bold text-xs transition">Edit</a>
                                        
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-700 border border-red-200 rounded hover:bg-red-100 font-bold text-xs transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-earth-500 font-medium">Belum ada data produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-earth-200 bg-earth-50 text-center text-sm text-earth-500">
                Menampilkan {{ $totalProducts }} produk.
            </div>
        </div>
    </div>
</x-admin-layout>
