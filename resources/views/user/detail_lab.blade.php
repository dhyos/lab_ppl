@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('user.dashboard') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Dashboard
    </a>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="h-64 md:h-80 bg-gray-200 relative">
            <img src="https://via.placeholder.com/800x400?text={{ urlencode($lab->nama_lab) }}" alt="{{ $lab->nama_lab }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                <div class="p-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $lab->nama_lab }}</h1>
                    <p class="text-blue-200 mt-2 text-lg">Kapasitas: {{ $lab->kapasitas }} Mahasiswa</p>
                </div>
            </div>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    Deskripsi & Fasilitas
                </h3>
                
                <div class="text-gray-600 leading-relaxed whitespace-pre-line text-justify">
                    {{ $lab->deskripsi }}
                </div>
            </div>

            <div class="md:col-span-1">
                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Ajukan Peminjaman</h3>
                    <p class="text-sm text-gray-600 mb-6">Pastikan Anda sudah membaca jadwal ketersediaan lab sebelum meminjam.</p>

                    @auth
                        <a href="{{ route('booking.create') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                            Pinjam Lab Ini
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                            Login untuk Meminjam
                        </a>
                        <p class="text-xs text-center text-gray-500 mt-3">Anda harus login terlebih dahulu.</p>
                    @endauth

                    <div class="mt-6 border-t border-blue-200 pt-4">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-white p-2 rounded-full text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Penanggung Jawab</p>
                                <p class="font-semibold text-gray-800">{{ $lab->admin->nama ?? 'Admin Lab' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection