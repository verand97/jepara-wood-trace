<x-admin-layout>
    <x-slot:title>Tambah Pengguna | Admin Dashboard</x-slot:title>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <a href="{{ route('admin.users.index') }}" class="text-earth-500 hover:text-earth-900 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <h1 class="text-3xl font-bold text-earth-900">Tambah Pengguna</h1>
                </div>
                <p class="text-earth-600">Buat akun pelanggan atau admin baru.</p>
            </div>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="bg-white rounded-3xl p-8 shadow-sm border border-earth-200">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-earth-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-red-500' : 'border-earth-200' }} focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-earth-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-xl border {{ $errors->has('email') ? 'border-red-500' : 'border-earth-200' }} focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-earth-700 mb-2">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border {{ $errors->has('password') ? 'border-red-500' : 'border-earth-200' }} focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-earth-700 mb-2">Ulangi Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-earth-700 mb-2">Role Akses</label>
                    <select name="role" class="w-full px-4 py-3 rounded-xl border {{ $errors->has('role') ? 'border-red-500' : 'border-earth-200' }} focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Pelanggan)</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin Toko</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-earth-100 flex gap-4">
                <button type="submit" class="px-8 py-3 bg-earth-900 text-earth-100 rounded-xl font-bold hover:bg-black transition-colors shadow-md">
                    Simpan Pengguna
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-8 py-3 bg-white text-earth-700 border border-earth-200 rounded-xl font-bold hover:bg-earth-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
