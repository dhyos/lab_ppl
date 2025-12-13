@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Laboratorium</h2>

    <form action="{{ route('admin.labs.update', $lab->id_lab) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lab</label>
            <input type="text" name="nama_lab" value="{{ $lab->nama_lab }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label>
            <input type="number" name="kapasitas" value="{{ $lab->kapasitas }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Admin Penanggung Jawab</label>
            <select name="id_admin" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                @foreach($admins as $admin)
                    <option value="{{ $admin->id }}" {{ $lab->id_admin == $admin->id ? 'selected' : '' }}>
                        {{ $admin->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>{{ $lab->deskripsi }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Update</button>
            <a href="{{ route('admin.labs') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection