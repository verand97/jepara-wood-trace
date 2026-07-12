<x-admin-layout>
    <x-slot:title>Pesanan Masuk | Admin Dashboard</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="text-earth-500 hover:text-earth-900 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <h1 class="text-3xl font-bold text-earth-900">Semua Pesanan</h1>
                </div>
                <p class="text-earth-600">Pantau seluruh transaksi pembelian pelanggan secara detail.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-earth-200 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-earth-200 text-earth-500 bg-earth-50 text-sm">
                            <th class="p-4 font-semibold uppercase tracking-wider">ID / Waktu</th>
                            <th class="p-4 font-semibold uppercase tracking-wider">Pelanggan</th>
                            <th class="p-4 font-semibold uppercase tracking-wider">Gateway</th>
                            <th class="p-4 font-semibold uppercase tracking-wider">Total</th>
                            <th class="p-4 font-semibold uppercase tracking-wider text-center">Status</th>
                            <th class="p-4 font-semibold uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-earth-800 text-sm">
                        @forelse($orders as $order)
                            <tr class="border-b border-earth-100 last:border-0 hover:bg-earth-50/80 transition">
                                <td class="p-4">
                                    <div class="font-bold text-earth-900">#JWT-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                    <div class="text-xs text-earth-500">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="font-medium text-earth-800">{{ $order->shipping_address['first_name'] ?? 'Guest' }} {{ $order->shipping_address['last_name'] ?? 'User' }}</div>
                                    <div class="text-xs text-earth-500">User ID: {{ $order->user_id }}</div>
                                </td>
                                <td class="p-4">
                                    <span class="font-mono text-xs uppercase text-earth-600 bg-earth-50 px-2 py-1 rounded inline-block border border-earth-100">
                                        {{ $order->payment_gateway }}
                                    </span>
                                </td>
                                <td class="p-4 font-bold text-earth-700">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</td>
                                <td class="p-4 text-center">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'PAID_MOCK' => 'bg-green-100 text-green-800',
                                            'processing' => 'bg-blue-100 text-blue-800',
                                            'shipped' => 'bg-purple-100 text-purple-800',
                                            'delivered' => 'bg-earth-100 text-earth-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                        $color = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                                        
                                        $statusLabels = [
                                            'pending' => 'Menunggu Pembayaran',
                                            'PAID_MOCK' => 'Lunas',
                                            'processing' => 'Sedang Diproses',
                                            'shipped' => 'Sedang Diantar',
                                            'delivered' => 'Pesanan Selesai',
                                            'cancelled' => 'Dibatalkan'
                                        ];
                                        $label = $statusLabels[$order->status] ?? $order->status;
                                    @endphp
                                    <span class="{{ $color }} px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wide whitespace-nowrap">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="p-4 text-right space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-earth-100 text-earth-700 hover:bg-earth-200 hover:text-earth-900 rounded-lg text-xs font-bold transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 rounded-lg text-xs font-bold transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-earth-500 font-medium">Belum ada data pesanan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-earth-200 bg-earth-50 text-center text-sm text-earth-500">
                Menampilkan {{ count($orders) }} pesanan.
            </div>
        </div>
    </div>
</x-admin-layout>
