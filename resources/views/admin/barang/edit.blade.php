@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Barang Inventaris</h2>

    <form action="{{ route('admin.barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('nama_barang') border-red-500 @enderror" required>
            @error('nama_barang')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Merek</label>
            <input type="text" name="merek" value="{{ old('merek', $barang->merek) }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('merek') border-red-500 @enderror" required>
            @error('merek')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Spesifikasi</label>
            <textarea name="spesifikasi" rows="4" 
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('spesifikasi') border-red-500 @enderror" required>{{ old('spesifikasi', $barang->spesifikasi) }}</textarea>
            @error('spesifikasi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
            <label class="block text-sm font-bold text-gray-700 mb-3">Foto Saat Ini</label>
            
            @if($barang->foto)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Barang" class="h-32 rounded shadow border">
                </div>
            @else
                <p class="text-gray-400 italic text-sm mb-4">Tidak ada foto.</p>
            @endif

            <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" 
                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
            @error('foto')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Update Barang</button>
            <a href="{{ route('admin.barang') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection