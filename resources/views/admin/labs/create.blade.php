@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Laboratorium</h2>

    <form action="{{ route('admin.labs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lab</label>
            <input type="text" name="nama_lab" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Lab Multimedia" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Laboratorium</label>
            <input type="file" name="gambar" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" accept="image/*">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label>
            <input type="number" name="kapasitas" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Jumlah Orang" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Dosen Penanggung Jawab</label>
            <input type="text" name="dosen_pj" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Nama Lengkap & Gelar Dosen" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Admin Penanggung Jawab</label>
            <select name="id_admin" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                @foreach($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->nama }} (NIM: {{ $admin->nim }})</option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">*Hanya menampilkan user dengan role Admin</p>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Fasilitas dan kegunaan lab..." required></textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Simpan</button>
            <a href="{{ route('admin.labs') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection