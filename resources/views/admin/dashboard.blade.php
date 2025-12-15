@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-500">Selamat datang kembali, Administrator.</p>
        </div>
        <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-semibold text-sm">
            {{ date('d F Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-4 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Laboratorium</p>
                <h3 class="text-2xl font-bold text-gray-800">4</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-4 bg-purple-50 text-purple-600 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Inventaris Barang</p>
                <h3 class="text-2xl font-bold text-gray-800">120</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-4 bg-orange-50 text-orange-600 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Menunggu Persetujuan</p>
                <h3 class="text-2xl font-bold text-gray-800">5</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('admin.labs') }}" class="group block bg-white border border-gray-200 rounded-xl p-6 hover:border-blue-500 hover:shadow-lg transition">
            <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600">Kelola Laboratorium &rarr;</h3>
            <p class="text-gray-500 mt-2 text-sm">Tambah, edit, atau hapus data laboratorium yang tersedia.</p>
        </a>
        <a href="{{ route('admin.barang') }}" class="group block bg-white border border-gray-200 rounded-xl p-6 hover:border-purple-500 hover:shadow-lg transition">
            <h3 class="text-lg font-bold text-gray-800 group-hover:text-purple-600">Kelola Barang &rarr;</h3>
            <p class="text-gray-500 mt-2 text-sm">Manajemen inventaris barang lab dan status kondisinya.</p>
        </a>
    </div>
@endsection