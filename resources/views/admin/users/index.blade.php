<x-admin-layout>
    <x-slot:title>Kelola Pengguna | Admin Dashboard</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="text-earth-500 hover:text-earth-900 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <h1 class="text-3xl font-bold text-earth-900">Kelola Pengguna</h1>
                </div>
                <p class="text-earth-600">Pantau seluruh akun pengguna dan administrator terdaftar.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-earth-900 text-earth-100 rounded-xl font-bold hover:bg-black transition-colors shadow-md flex items-center gap-2 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Pengguna
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-earth-200 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-earth-200 text-earth-500 bg-earth-50 text-sm">
                            <th class="p-4 font-semibold uppercase tracking-wider">Nama Lengkap</th>
                            <th class="p-4 font-semibold uppercase tracking-wider">Email</th>
                            <th class="p-4 font-semibold uppercase tracking-wider text-center">Role</th>
                            <th class="p-4 font-semibold uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-earth-800 text-sm">
                    @forelse($users as $user)
                        <tr class="border-b border-earth-100 last:border-0 hover:bg-earth-50/80 transition">
                            <td class="p-4 font-bold text-earth-900">
                                {{ $user->name }}
                            </td>
                            <td class="p-4 text-earth-600">
                                {{ $user->email }}
                            </td>
                            <td class="p-4 text-center">
                                @if($user->is_admin)
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wide">
                                        Admin
                                    </span>
                                @else
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wide">
                                        User
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-earth-100 text-earth-700 hover:bg-earth-200 hover:text-earth-900 rounded-lg text-xs font-bold transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>
                                @if(auth()->id() != $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 rounded-lg text-xs font-bold transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-earth-500 font-medium">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-earth-200 bg-earth-50 text-center text-sm text-earth-500">
            Menampilkan {{ count($users) }} pengguna.
        </div>
    </div>
</div>
</x-admin-layout>
