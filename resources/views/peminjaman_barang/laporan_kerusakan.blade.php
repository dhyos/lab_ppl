@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-8">

        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">
                Form Laporan Kerusakan
            </h2>
            <p class="text-sm text-gray-500">
                Silakan isi data kerusakan barang
            </p>
        </div>

        <form action="{{ route('store_laporan_kerusakan') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Peminjaman Detail ID
                </label>
                <input type="number" name="peminjaman_detil_id"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan ID peminjaman"
                    required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Deskripsi Kerusakan
                </label>
                <textarea name="deskripsi" rows="3"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: Layar pecah, keyboard rusak..."
                    required></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Biaya Perbaikan (Rp)
                </label>
                <input type="number" name="biaya_perbaikan"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Contoh: 150000"
                    required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Status
                </label>
                <select name="status"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Diajukan">Diajukan</option>
                    <option value="Diperbaiki">Diperbaiki</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('index.barang') }}"
                   class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300
                          text-gray-700 hover:bg-gray-100 transition">
                    ← Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center px-6 py-2 rounded-lg bg-blue-600
                           text-white font-semibold hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
