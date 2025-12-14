@extends('layouts.main')

@section('content')

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 mb-10 text-white shadow-xl relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-white opacity-10"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-40 h-40 rounded-full bg-white opacity-10"></div>

        <div class="relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Selamat Datang di SiLab!</h1>
            <p class="text-blue-100 max-w-2xl text-lg">Platform terintegrasi untuk melihat jadwal, meminjam peralatan, dan reservasi laboratorium dengan mudah dan cepat.</p>
            
            <div class="mt-6 flex gap-3">
                <a href="{{ route('booking.calendar') }}" class="bg-white text-blue-700 px-5 py-2.5 rounded-lg font-semibold shadow hover:bg-gray-100 transition">Cek Jadwal</a>
                @guest
                    <a href="{{ route('login') }}" class="bg-blue-500 bg-opacity-40 border border-blue-400 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-opacity-60 transition">Login Sekarang</a>
                @endguest
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-3">Daftar Laboratorium</h2>
        <a href="#" class="text-blue-600 text-sm hover:underline">Lihat Semua</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($labs as $lab)
        <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full">
            <div class="h-40 bg-gray-200 relative overflow-hidden">
                <img src="https://via.placeholder.com/400x200?text={{ urlencode($lab->nama_lab) }}" alt="{{ $lab->nama_lab }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                
                <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">
                    {{ $lab->kapasitas }} Org
                </div>
            </div>
            
            <div class="p-5 flex flex-col flex-grow">
                <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight">{{ $lab->nama_lab }}</h3>
                
                <p class="text-gray-500 text-sm mb-4 flex-grow">
                    {{ Str::limit($lab->deskripsi, 80, '...') }}
                </p>
                
                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                    <span class="text-xs text-gray-500">
                        Kapasitas: <span class="font-bold text-gray-700">{{ $lab->kapasitas }}</span>
                    </span>
                    
                    <a href="{{ route('lab.detail', $lab->id_lab) }}" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 group-hover:translate-x-1 transition">
                        Lihat Detail
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 flex items-start gap-4">
            <div class="bg-blue-600 text-white p-3 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-800">Cek Ketersediaan</h4>
                <p class="text-sm text-gray-600 mt-1">Lihat jadwal kosong lab secara realtime sebelum meminjam.</p>
            </div>
        </div>
        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100 flex items-start gap-4">
            <div class="bg-indigo-600 text-white p-3 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-800">Prosedur Peminjaman</h4>
                <p class="text-sm text-gray-600 mt-1">Baca SOP peminjaman barang dan lab agar pengajuan diterima.</p>
            </div>
        </div>
        <div class="bg-purple-50 p-6 rounded-xl border border-purple-100 flex items-start gap-4">
            <div class="bg-purple-600 text-white p-3 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-800">Riwayat Saya</h4>
                <p class="text-sm text-gray-600 mt-1">Pantau status pengajuan peminjaman Anda di sini.</p>
            </div>
        </div>
    </div>

@endsection