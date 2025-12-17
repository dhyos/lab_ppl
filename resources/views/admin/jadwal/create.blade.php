@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center gap-3 mb-6">
                <a href="{{ route('admin.jadwal.index') }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Tambah Jadwal Lab</h1>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                    <p class="font-bold">Error</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
                    <div>
                        <p class="font-bold">Error</p>
                        <p>{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900 font-bold text-xl">&times;</button>
                </div>
            @endif

            <form action="{{ route('admin.jadwal.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="lab_id" class="block text-sm font-medium text-gray-700 mb-2">Laboratorium</label>
                    <select name="lab_id" id="lab_id" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                        <option value="">Pilih Laboratorium</option>
                        @forelse($labs as $lab)
                            <option value="{{ $lab->id_lab }}">{{ $lab->nama_lab }}</option>
                        @empty
                            <option value="" disabled>Tidak ada laboratorium tersedia</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-4">
                    <label for="hari" class="block text-sm font-medium text-gray-700 mb-2">Hari</label>
                    <select name="hari" id="hari" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                        <option value="">Pilih Hari</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                        <option value="minggu">Minggu</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal (Opsional)</label>
                    <input type="date" name="tanggal" id="tanggal" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="kegiatan" class="block text-sm font-medium text-gray-700 mb-2">Kegiatan</label>
                    <select name="kegiatan" id="kegiatan" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                        <option value="">Pilih Kegiatan</option>
                        <option value="Mata Kuliah">Mata Kuliah</option>
                        <option value="Praktikum">Praktikum</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">Batal</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection