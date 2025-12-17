@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center shadow-xl rounded-xl mb-6 p-4 bg-white">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">Peminjaman Barang</h1>
        
        <div class="grid grid-cols-1 gap-3 md:grid-cols-4 w-full md:w-auto">
            <a href="#" class="w-full bg-sky-600 hover:bg-sky-700 text-white py-2 px-4 rounded-lg font-semibold shadow-md hover:scale-105 transition-all text-center">Unduh File</a>
            <a href="{{ route('form_peminjaman_brg.barang') }}" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg font-semibold shadow-md hover:scale-105 transition-all text-center">Form Peminjaman</a>
            <a href="{{ route('riwayat_peminjaman') }}" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 px-4 rounded-lg font-semibold shadow-md hover:scale-105 transition-all text-center">Riwayat Peminjaman</a>
            <a href="{{ route('laporan_kerusakan') }}" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-semibold shadow-md hover:scale-105 transition-all text-center">Laporan Kerusakan</a>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-6 text-blue-700">Daftar Barang</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($barang as $b)
            <div class="border rounded-xl shadow-sm p-4 bg-gray-50 hover:shadow-lg hover:scale-105 transition-all duration-300">
                <img src="https://via.placeholder.com/200"
                     class="w-full h-48 object-cover rounded-md mb-3">

                <h3 class="font-bold text-lg text-gray-800">{{ $b['nama_barang'] }}</h3>
                <p class="text-gray-500 text-sm mb-1">{{ $b['merek'] }}</p>

                <p class="mt-2 text-gray-700 text-sm line-clamp-3">
                    {{ $b['spesifikasi'] }}
                </p>

                <div class="mt-3">
                    <a href="#" class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-1 px-3 rounded-lg shadow-md hover:scale-105 transition-all">Pinjam</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
