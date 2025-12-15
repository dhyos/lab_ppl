@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Ajukan Peminjaman</h1>
                <p class="text-gray-600 mt-1">Isi formulir di bawah untuk meminjam fasilitas laboratorium.</p>
            </div>
            <a href="{{ route('booking.history') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                &larr; Lihat Riwayat
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                <p class="font-bold">Terjadi Kesalahan</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-8">
                <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Laboratorium</label>
                        <select name="id_lab" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm" required>
                            <option value="" disabled selected>-- Pilih Lab --</option>
                            @foreach($labs as $lab)
                                <option value="{{ $lab->id_lab }}">{{ $lab->nama_lab }} (Kapasitas: {{ $lab->kapasitas }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Keperluan Peminjaman</label>
                        <textarea name="keperluan" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition shadow-sm" placeholder="Contoh: Praktikum Pemrograman Web kelas A..." required></textarea>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                        <label class="block text-sm font-bold text-blue-800 mb-2">Upload Surat Peminjaman</label>
                        
                        <div class="mb-4 text-sm">
                            <span class="text-gray-600">Belum punya format surat?</span>
                            <a href="{{ route('booking.format.download') }}" class="text-blue-600 hover:text-blue-800 font-semibold underline decoration-blue-300 hover:decoration-blue-800 ml-1">
                                Download Template Surat Disini
                            </a>
                        </div>

                        <input type="file" name="dokumen" class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-600 file:text-white
                            hover:file:bg-blue-700
                            cursor-pointer" required>
                        <p class="text-xs text-gray-500 mt-2">*Format: PDF/JPG/PNG. Maksimal 2MB.</p>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                            Ajukan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection