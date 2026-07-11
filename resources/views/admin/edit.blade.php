<x-layout>
    <x-slot:title>Edit Produk | Jepara Wood-Trace</x-slot:title>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.dashboard') }}" class="text-earth-500 hover:text-earth-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-earth-900">Edit Produk: {{ $product->title }}</h1>
                <p class="text-earth-600 mt-1">Ubah rincian karya seni Jepara.</p>
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

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-earth-800 mb-2">Nama Karya / Judul Produk *</label>
                        <input type="text" name="title" value="{{ old('title', $product->title) }}" required class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-earth-800 mb-2">Pilih Seniman (Artist) *</label>
                        <select name="artist_id" required class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                            <option value="">-- Pilih Seniman --</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}" {{ old('artist_id', $product->artist_id) == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-earth-800 mb-2">Metode Produksi *</label>
                        <select name="production_method" required class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                            <option value="Hand-Carved" {{ old('production_method', $product->production_method) == 'Hand-Carved' ? 'selected' : '' }}>Hand-Carved (Ukiran Tangan)</option>
                            <option value="CNC-Assisted" {{ old('production_method', $product->production_method) == 'CNC-Assisted' ? 'selected' : '' }}>CNC-Assisted</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-earth-800 mb-2">Harga (IDR) *</label>
                        <input type="number" name="price" value="{{ old('price', (int)$product->price) }}" required min="0" class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-earth-800 mb-2">Jumlah Stok *</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-earth-800 mb-2">Nomor Sertifikat SVLK (Opsional)</label>
                        <input type="text" name="svlk_certificate_number" value="{{ old('svlk_certificate_number', $product->svlk_certificate_number) }}" class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50 font-mono text-sm" placeholder="Contoh: VLK-ID-12345">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-earth-800 mb-2">Deskripsi Produk *</label>
                        <textarea name="description" rows="5" required class="w-full px-4 py-3 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50/50">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="sm:col-span-2 border-2 border-dashed border-earth-200 rounded-xl p-8 bg-earth-50/30 flex flex-col sm:flex-row items-center gap-8">
                        @php
                            $imageUrl = null;
                            if(is_array($product->images) && count($product->images) > 0) {
                                $imageUrl = asset('images/products/' . $product->images[0]);
                            } elseif(file_exists(public_path('images/products/' . $product->id . '.jpg'))) {
                                $imageUrl = asset('images/products/' . $product->id . '.jpg');
                            }
                        @endphp
                        
                        @if($imageUrl)
                            <div class="shrink-0 w-32 h-32 bg-earth-200 rounded-xl overflow-hidden border border-earth-200 shadow">
                                <img src="{{ $imageUrl }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-earth-800 mb-2">Ganti Foto Utama (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="block w-full text-sm text-earth-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-earth-100 file:text-earth-700 hover:file:bg-earth-200">
                            <p class="text-xs text-earth-400 mt-2">Biarkan kosong jika tidak ingin mengubah foto. Format yang didukung: JPG, PNG, WEBP. Maks 2MB.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-earth-100 flex justify-end gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-white text-earth-700 border border-earth-200 rounded-xl font-bold hover:bg-earth-50 transition">Batal</a>
                    <button type="submit" class="px-8 py-3 bg-earth-900 text-earth-100 rounded-xl font-bold hover:bg-black transition shadow-lg transform hover:-translate-y-0.5">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
