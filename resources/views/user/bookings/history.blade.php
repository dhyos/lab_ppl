@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Riwayat Peminjaman</h1>
                <p class="text-gray-600 mt-1">Daftar pengajuan peminjaman laboratorium Anda.</p>
            </div>
            <a href="{{ route('booking.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition transform hover:-translate-y-0.5">
                + Ajukan Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold">Berhasil</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold">Gagal</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-bold">
                        <tr>
                            <th class="px-6 py-4 border-b">No</th>
                            <th class="px-6 py-4 border-b">Laboratorium</th>
                            <th class="px-6 py-4 border-b">Waktu</th>
                            <th class="px-6 py-4 border-b">Status</th>
                            <th class="px-6 py-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($bookings as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $item->lab->nama_lab ?? 'Lab Dihapus' }}
                                <div class="text-xs text-gray-500 mt-1 font-normal truncate max-w-[150px]" title="{{ $item->keperluan }}">
                                    {{ $item->keperluan }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $item->jam_mulai }} - {{ $item->jam_selesai }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                @elseif($item->status == 'approved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            
                            {{-- BAGIAN INI YANG DIMODIFIKASI --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    
                                    {{-- 1. Tombol Cetak Bukti (Hanya jika Approved) --}}
                                    @if($item->status == 'approved')
                                        <a href="{{ route('booking.cetak', $item->id) }}" target="_blank" class="flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-3 py-1.5 rounded shadow transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            Cetak Bukti
                                        </a>
                                    @endif

                                    {{-- 2. Link File Proposal (Jika ada) --}}
                                    @if($item->file_surat)
                                        <a href="{{ asset('storage/' . $item->file_surat) }}" target="_blank" class="text-gray-500 hover:text-blue-600 text-xs underline mt-1">
                                            Lihat Proposal Saya
                                        </a>
                                    @endif
                                    
                                </div>
                            </td>

                        </tr>
                        @if($item->status == 'rejected' && $item->catatan_penolakan)
                        <tr class="bg-red-50">
                            <td colspan="5" class="px-6 py-3 text-sm text-red-700 border-b border-red-100">
                                <strong>Alasan Penolakan:</strong> {{ $item->catatan_penolakan }}
                            </td>
                        </tr>
                        @endif

                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p>Belum ada riwayat peminjaman.</p>
                                <a href="{{ route('booking.create') }}" class="text-blue-600 hover:underline mt-1 inline-block">Mulai ajukan peminjaman</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
<div id="instructionModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-60 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-lg transform scale-100 transition-transform duration-300 relative">
            
            {{-- Tombol Close (X) di pojok kanan atas --}}
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            {{-- Ikon Sukses --}}
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6 animate-bounce">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            {{-- Judul --}}
            <h3 class="text-2xl font-bold text-center text-gray-900 mb-2">Pengajuan Terkirim!</h3>
            
            {{-- Status --}}
            <p class="text-center text-gray-600 mb-6">
                Status peminjaman Anda saat ini: <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">PENDING</span>
            </p>

            {{-- KOTAK PERINGATAN / INSTRUKSI (PENTING) --}}
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 rounded-r-lg text-left shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        {{-- Icon Peringatan --}}
                        <svg class="h-6 w-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-800 uppercase tracking-wide">
                            Agar pengajuan Anda diproses lebih lanjut, harap segera menyerahkan <strong>Surat Peminjaman Fisik (Hard Copy)</strong> ke Admin/Asisten Laboratorium yang Anda ajukan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="text-center">
                <button onclick="closeModal()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 duration-150 ease-in-out">
                    Mengerti
                </button>
            </div>
        </div>
    </div>

    {{-- SCRIPT LOGIKA MODAL --}}
    <script>
        // Fungsi Tutup Modal
        function closeModal() {
            const modal = document.getElementById('instructionModal');
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.opacity = '1';
            }, 300);
        }

        // Event Listener saat halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah ada session 'success' dari Laravel Controller
            // Session 'success' dikirim saat redirect dari BookingController
            @if(session('success'))
                {
                    const modal = document.getElementById('instructionModal');
                    // Hapus class hidden agar muncul
                    modal.classList.remove('hidden');
                }
            @endif
        });
    </script>
@endsection