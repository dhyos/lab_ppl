@extends('layouts.main')

@section('content')
<div class="container mx-auto mt-8 px-4">

    <h2 class="text-2xl font-bold mb-6 text-gray-700">
        Riwayat Peminjaman Barang
    </h2>
    <div class="mb-4">
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
        ← Kembali
    </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border px-4 py-3 text-center">No Pinjam</th>
                    <th class="border px-4 py-3">Nama Barang</th>
                    <th class="border px-4 py-3 text-center">Jumlah</th>
                    <th class="border px-4 py-3 text-center">Status</th>
                    <th class="border px-4 py-3 text-center">Tanggal Pinjam</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 0; ?>
                @forelse($detail_pinjam as $item)
                    <?php $no++; ?>
                    @if($item->peminjaman->id_user == $id_user)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2 text-center">
                            <?= $no; ?>
                        </td>

                        {{-- Nama Barang --}}
                        <td class="border px-4 py-2">
                            {{ $item->peminjaman_barang->nama_barang ?? '-' }}
                        </td>

                        {{-- Jumlah --}}
                        <td class="border px-4 py-2 text-center">
                            {{ $item->jumlah }}
                        </td>

                        {{-- Status --}}
                        <td class="border px-4 py-2 text-center">
                            @if($item->status === 'pending')
                                <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">
                                    Pending
                                </span>
                            @else
                                <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">
                                    {{ ucfirst($item->status) }}
                                </span>
                            @endif
                        </td>

                        {{-- Tanggal Pinjam --}}
                        <td class="border px-4 py-2 text-center">
                            {{ optional($item->peminjaman)->tanggal_pinjam ?? '-' }}
                        </td>
                    </tr>
                @endif
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            Data riwayat peminjaman belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
