@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('user.dashboard') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Dashboard
    </a>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="h-64 md:h-80 bg-gray-200 relative group">
            @if($lab->gambar)
                <img src="{{ asset('storage/' . $lab->gambar) }}" alt="{{ $lab->nama_lab }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
            @else
                <img src="https://via.placeholder.com/800x400?text={{ urlencode($lab->nama_lab) }}" alt="{{ $lab->nama_lab }}" class="w-full h-full object-cover">
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end">
                <div class="p-8 w-full">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $lab->nama_lab }}</h1>
                    <div class="flex items-center gap-4 text-blue-200 text-sm md:text-base">
                        <span class="flex items-center gap-1 bg-black/30 px-3 py-1 rounded-full backdrop-blur-sm border border-white/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Kapasitas: {{ $lab->kapasitas }} Mahasiswa
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2 border-b pb-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    Deskripsi & Fasilitas
                </h3>
                
                <div class="text-gray-600 leading-relaxed whitespace-pre-line text-justify text-base">
                    {{ $lab->deskripsi }}
                </div>
            </div>

            <div class="md:col-span-1">
                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 sticky top-24 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Ajukan Peminjaman
                    </h3>
                    <p class="text-sm text-gray-600 mb-6">Pastikan Anda sudah membaca jadwal ketersediaan lab sebelum meminjam.</p>

                    @auth
                        <a href="{{ route('peminjaman') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                            Pinjam Lab Ini
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                            Login untuk Meminjam
                        </a>
                        <p class="text-xs text-center text-gray-500 mt-3">Anda harus login terlebih dahulu.</p>
                    @endauth

                    <div class="mt-6 border-t border-blue-200 pt-4 space-y-4">
                        
                        <div class="flex items-start gap-3">
                            <div class="bg-white p-2 rounded-full text-blue-600 border border-blue-100 shadow-sm mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Dosen PJ</p>
                                <p class="font-semibold text-gray-800 text-sm leading-tight">{{ $lab->dosen_pj ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="bg-white p-2 rounded-full text-blue-600 border border-blue-100 shadow-sm mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Admin Lab</p>
                                <p class="font-semibold text-gray-800 text-sm leading-tight">{{ $lab->admin->nama ?? 'Admin' }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection