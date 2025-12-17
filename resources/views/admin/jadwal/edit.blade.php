@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center gap-3 mb-6">
                <a href="{{ route('admin.jadwal.index') }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Edit Jadwal Lab</h1>
            </div>

            <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="lab_id" class="block text-sm font-medium text-gray-700 mb-2">Laboratorium</label>
                    <select name="lab_id" id="lab_id" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                        <option value="">Pilih Laboratorium</option>
                        @foreach($labs as $lab)
                            <option value="{{ $lab->id_lab }}" {{ $jadwal->lab_id == $lab->id_lab ? 'selected' : '' }}>{{ $lab->nama_lab }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="hari" class="block text-sm font-medium text-gray-700 mb-2">Hari</label>
                    <select name="hari" id="hari" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                        <option value="">Pilih Hari</option>
                        <option value="senin" {{ $jadwal->hari == 'senin' ? 'selected' : '' }}>Senin</option>
                        <option value="selasa" {{ $jadwal->hari == 'selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="rabu" {{ $jadwal->hari == 'rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="kamis" {{ $jadwal->hari == 'kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="jumat" {{ $jadwal->hari == 'jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="sabtu" {{ $jadwal->hari == 'sabtu' ? 'selected' : '' }}>Sabtu</option>
                        <option value="minggu" {{ $jadwal->hari == 'minggu' ? 'selected' : '' }}>Minggu</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal (Opsional)</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ $jadwal->tanggal }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ $jadwal->jam_mulai }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" value="{{ $jadwal->jam_selesai }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="kegiatan" class="block text-sm font-medium text-gray-700 mb-2">Kegiatan</label>
                    <select name="kegiatan" id="kegiatan" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none" required>
                        <option value="">Pilih Kegiatan</option>
                        <option value="Mata Kuliah" {{ $jadwal->kegiatan == 'Mata Kuliah' ? 'selected' : '' }}>Mata Kuliah</option>
                        <option value="Praktikum" {{ $jadwal->kegiatan == 'Praktikum' ? 'selected' : '' }}>Praktikum</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="w-full border border-gray-300 rounded-lg p-3 bg-gray-50 text-gray-600">
                        {{ ucfirst($jadwal->status) }}
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Status otomatis berdasarkan konflik jadwal</p>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">Batal</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection