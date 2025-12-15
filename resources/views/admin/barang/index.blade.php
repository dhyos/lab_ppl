@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Barang Inventaris</h2>
        <a href="{{ route('admin.barang.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Tambah Barang
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase">
                    <th class="p-4 border-b w-16">No</th>
                    <th class="p-4 border-b w-24">Foto</th>
                    <th class="p-4 border-b">Nama Barang</th>
                    <th class="p-4 border-b">Merek</th>
                    <th class="p-4 border-b">Spesifikasi</th>
                    <th class="p-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @forelse($barangs as $index => $barang)
                <tr class="hover:bg-gray-50 transition border-b">
                    <td class="p-4 text-gray-500">{{ $index + 1 }}</td>
                    
                    <td class="p-4">
                        @if($barang->foto)
                            <img src="{{ asset('storage/' . $barang->foto) }}" 
                                 alt="{{ $barang->nama_barang }}" 
                                 class="w-16 h-16 object-cover rounded shadow-sm border border-gray-200">
                        @else
                            <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400 text-center border">
                                No Image
                            </div>
                        @endif
                    </td>

                    <td class="p-4 font-semibold text-gray-800">{{ $barang->nama_barang }}</td>

                    <td class="p-4">
                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-medium border border-blue-100">
                            {{ $barang->merek }}
                        </span>
                    </td>

                    <td class="p-4 text-gray-500 max-w-xs truncate" title="{{ $barang->spesifikasi }}">
                        {{ Str::limit($barang->spesifikasi, 50) }}
                    </td>

                    <td class="p-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.barang.edit', $barang->id_barang) }}" class="text-yellow-600 hover:text-yellow-800 bg-yellow-50 px-3 py-1 rounded border border-yellow-200 text-xs font-medium">
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.barang.destroy', $barang->id_barang) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 bg-red-50 px-3 py-1 rounded border border-red-200 text-xs font-medium">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p>Belum ada data barang.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection