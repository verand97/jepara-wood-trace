<x-layout>
    <x-slot:title>Tambah Produk Baru | Jepara Wood-Trace</x-slot:title>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.dashboard') }}" class="text-earth-500 hover:text-earth-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-earth-900">Tambah Produk Baru</h1>
                <p class="text-earth-600 mt-1">Masukkan rincian karya seni Jepara untuk ditambahkan ke galeri.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-earth-200 shadow-xl overflow-hidden p-8 sm:p-10">
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-earth-800 mb-2">Nama Karya / Judul Produk *</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-earth-800 mb-2">Pilih Seniman (Artist) *</label>
                        <select name="artist_id" required class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                            <option value="">-- Pilih Seniman --</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-earth-800 mb-2">Metode Produksi *</label>
                        <select name="production_method" required class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                            <option value="Hand-Carved" {{ old('production_method') == 'Hand-Carved' ? 'selected' : '' }}>Hand-Carved (Ukiran Tangan)</option>
                            <option value="CNC-Assisted" {{ old('production_method') == 'CNC-Assisted' ? 'selected' : '' }}>CNC-Assisted</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-earth-800 mb-2">Harga (IDR) *</label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0" class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-earth-800 mb-2">Jumlah Stok *</label>
                        <input type="number" name="stock" value="{{ old('stock', 1) }}" required min="0" class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-earth-800 mb-2">Nomor Sertifikat SVLK (Opsional)</label>
                        <input type="text" name="svlk_certificate_number" value="{{ old('svlk_certificate_number') }}" class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50 font-mono text-sm" placeholder="Contoh: VLK-ID-12345">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-earth-800 mb-2">Deskripsi Produk *</label>
                        <textarea name="description" rows="5" required class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">{{ old('description') }}</textarea>
                    </div>

                    <div class="sm:col-span-2 border-2 border-dashed border-earth-200 rounded-xl p-8 text-center bg-earth-50/30">
                        <label class="block text-sm font-bold text-earth-800 mb-4">Unggah Foto Utama Produk (Opsional)</label>
                        <input type="file" name="image" accept="image/*" class="block w-full text-sm text-earth-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-earth-100 file:text-earth-700 hover:file:bg-earth-200">
                        <p class="text-xs text-earth-400 mt-2">Format yang didukung: JPG, PNG, WEBP. Maksimal 2MB.</p>
                    </div>
                </div>

                <div class="pt-6 border-t border-earth-100 flex justify-end gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-white text-earth-700 border border-earth-200 rounded-xl font-bold hover:bg-earth-50 transition">Batal</a>
                    <button type="submit" class="px-8 py-3 bg-earth-900 text-earth-100 rounded-xl font-bold hover:bg-black transition shadow-lg transform hover:-translate-y-0.5">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
