@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Ajukan Peminjaman</h1>
                <p class="text-gray-500 mt-2 text-sm">Lengkapi formulir di bawah ini untuk reservasi fasilitas laboratorium.</p>
            </div>
        </div>

        @if(session('error'))
            <div class="mb-6 rounded-lg bg-red-50 p-4 border-l-4 border-red-500 shadow-sm flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Gagal Memproses</h3>
                    <div class="mt-1 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="p-8 sm:p-10">
                <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700">Laboratorium Tujuan</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <select name="id_lab" class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 transition duration-200 ease-in-out bg-gray-50 focus:bg-white" required>
                                    <option value="" disabled selected>-- Pilih Laboratorium --</option>
                                    @foreach($labs as $lab)
                                        <option value="{{ $lab->id_lab }}">{{ $lab->nama_lab }} (Kapasitas: {{ $lab->kapasitas }} Orang)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700">Nomor WhatsApp / HP</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    {{-- Ikon Telepon --}}
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input type="number" name="no_hp" class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 transition duration-200 ease-in-out bg-gray-50 focus:bg-white" placeholder="Nomor" required>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 my-6"></div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700">Tanggal Pinjam</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="date" name="tanggal_pinjam" class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2.5 transition bg-gray-50 focus:bg-white" required>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700">Jam Mulai</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <input type="time" name="jam_mulai" class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2.5 transition bg-gray-50 focus:bg-white" required>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700">Jam Selesai</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <input type="time" name="jam_selesai" class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2.5 transition bg-gray-50 focus:bg-white" required>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700">Keperluan Peminjaman</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <textarea name="keperluan" rows="3" class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 transition bg-gray-50 focus:bg-white" placeholder="Contoh: Kegiatan Workshop Himpunan..." required></textarea>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 p-6 hover:border-blue-400 transition-colors duration-300">
                        <label class="block text-sm font-bold text-gray-800 mb-2">Upload Surat Peminjaman</label>
                        
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <input type="file" name="dokumen" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2.5 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-bold
                                    file:bg-blue-600 file:text-white
                                    hover:file:bg-blue-700
                                    file:transition file:duration-200
                                    cursor-pointer" required>
                                <p class="text-xs text-gray-500 mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Format: PDF/JPG/PNG (Maks. 2MB)
                                </p>
                            </div>
                            
                            <div class="hidden md:block h-10 w-px bg-gray-300 mx-2"></div>

                            <div class="text-sm">
                                <span class="text-gray-600">Belum punya format?</span>
                                <a href="{{ route('booking.format.download') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold ml-1 hover:underline group">
                                    <svg class="w-4 h-4 mr-1 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Download Template
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition hover:-translate-y-0.5 duration-200">
                            Ajukan Peminjaman Sekarang
                        </button>
                    </div>
                    <p class="text-center text-gray-600 text-xs mt-8">Pastikan data yang Anda masukkan sudah benar sebelum mengirimkan permohonan.</p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection