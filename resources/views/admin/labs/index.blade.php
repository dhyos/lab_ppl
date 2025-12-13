@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Laboratorium</h2>
        <a href="{{ route('admin.labs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Tambah Lab
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
                    <th class="p-4 border-b">Nama Lab</th>
                    <th class="p-4 border-b">Kapasitas</th>
                    <th class="p-4 border-b">Penanggung Jawab (Admin)</th>
                    <th class="p-4 border-b">Deskripsi</th>
                    <th class="p-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @foreach($labs as $lab)
                <tr class="hover:bg-gray-50 transition border-b">
                    <td class="p-4 font-semibold">{{ $lab->nama_lab }}</td>
                    <td class="p-4">{{ $lab->kapasitas }} Orang</td>
                    <td class="p-4">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">
                            {{ $lab->admin->nama ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-500 truncate max-w-xs">{{Str::limit($lab->deskripsi, 50)}}</td>
                    <td class="p-4 flex justify-center gap-2">
                        <a href="{{ route('admin.labs.edit', $lab->id_lab) }}" class="text-yellow-600 hover:text-yellow-800 bg-yellow-50 px-3 py-1 rounded border border-yellow-200">
                            Edit
                        </a>
                        <form action="{{ route('admin.labs.destroy', $lab->id_lab) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lab ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 bg-red-50 px-3 py-1 rounded border border-red-200">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection