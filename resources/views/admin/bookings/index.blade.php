@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
<div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Persetujuan Peminjaman</h1>
            <p class="text-gray-500 mt-1">Kelola permohonan peminjaman laboratorium dari mahasiswa.</p>
        </div>
        
        <div class="flex gap-3">
            <a href="{{ route('admin.settings.format') }}" class="flex items-center gap-2 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition shadow-sm font-medium">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Atur Format Surat
            </a>

            @if($pendingCount > 0)
            <div class="flex items-center gap-2 bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg font-semibold text-sm shadow-sm border border-yellow-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                {{ $pendingCount }} Pending
            </div>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
            <div>
                <p class="font-bold">Berhasil</p>
                <p>{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900 font-bold text-xl">&times;</button>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Lab & Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Keperluan</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Surat</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">{{ $item->user->nama ?? 'User Terhapus' }}</div>
                            <div class="text-xs text-gray-500">{{ $item->user->nim ?? '-' }}</div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-blue-600 mb-1">{{ $item->lab->nama_lab ?? 'Lab Terhapus' }}</div>
                            <div class="text-xs text-gray-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                            </div>
                            <div class="text-xs text-gray-600 flex items-center gap-1 mt-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $item->jam_mulai }} - {{ $item->jam_selesai }}
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-600 line-clamp-2 w-48" title="{{ $item->keperluan }}">
                                {{ $item->keperluan }}
                            </p>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ asset('storage/' . $item->file_surat) }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Lihat File
                            </a>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($item->status == 'pending')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    Menunggu
                                </span>
                            @elseif($item->status == 'approved')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                    Disetujui
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                    Ditolak
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            @if($item->status == 'pending')
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('admin.booking.update', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menyetujui peminjaman ini?')">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg transition shadow-sm" title="Setujui">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>

                                    <button onclick="openRejectModal('{{ $item->id }}')" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition shadow-sm" title="Tolak">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            @else
                                <span class="text-gray-400 text-xs italic">Selesai</span>
                                @if($item->status == 'rejected')
                                    <button onclick="alert('Alasan Penolakan: {{ $item->catatan_penolakan }}')" class="text-red-500 hover:text-red-700 ml-2" title="Lihat Alasan">
                                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            <p>Belum ada data pengajuan peminjaman.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-bold text-gray-900 mb-2">Tolak Peminjaman</h3>
            <p class="text-sm text-gray-500 mb-4">Silakan masukkan alasan penolakan agar mahasiswa tahu.</p>
            
            <form id="rejectForm" action="" method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="rejected">
                
                <textarea name="catatan_penolakan" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-red-200 focus:border-red-500 outline-none" rows="3" placeholder="Contoh: Jadwal bentrok dengan praktikum..." required></textarea>
                
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-lg hover:bg-gray-300 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-bold rounded-lg hover:bg-red-700 transition shadow-lg">Kirim Penolakan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openRejectModal(id) {
        // Set action form dinamis berdasarkan ID booking
        let form = document.getElementById('rejectForm');
        form.action = "/admin/peminjaman/" + id; // Pastikan URL ini sesuai route Anda
        
        // Tampilkan modal
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }

    // Tutup modal jika klik di luar area putih
    window.onclick = function(event) {
        let modal = document.getElementById('rejectModal');
        if (event.target == modal) {
            closeRejectModal();
        }
    }
</script>
@endsection