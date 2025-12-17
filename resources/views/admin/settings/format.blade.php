@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4 text-2xl font-bold text-gray-800">Pengaturan Format Surat</h1>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <p class="text-gray-600 mb-6">
            Upload file format surat peminjaman terbaru di sini. File ini yang akan didownload oleh mahasiswa saat mengajukan peminjaman.
        </p>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">File Format Baru (DOCX/PDF)</label>
                <input type="file" name="format_file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Simpan & Update Format
                </button>
            </div>
        </form>
        
        <div class="mt-8 border-t pt-4">
            <h3 class="text-sm font-semibold text-gray-500">Preview File Saat Ini:</h3>
            <a href="{{ route('booking.format.download') }}" class="text-blue-500 hover:text-blue-700 text-sm mt-2 inline-block">
                <i class="fas fa-download"></i> Coba Download File Saat Ini
            </a>
        </div>
    </div>
</div>
@endsection