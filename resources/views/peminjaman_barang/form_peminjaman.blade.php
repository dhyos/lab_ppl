@extends('layouts.main')

@section('content')

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif


<div class="grid grid-cols-1 gap-6 mt-10 md:grid-cols-3">
    <div class="font-mono max-w-sm border border-gray-300 p-6 mx-auto rounded-lg shadow-lg bg-white">
        <h4 class="text-center text-red-600 font-semibold text-lg mb-2">Peringatan!</h4>
        <p class="text-justify text-gray-700 text-sm">
            Jika ingin meminjam lebih dari satu barang, isi form Barang, Jumlah, dan Catatan terlebih dahulu.
            Setelah menambah semua barang, lengkapi Tanggal Pinjam dan upload bukti Surat Peminjaman.
        </p>
    </div>

    <!-- Kolom Form Tambah Barang + Tabel -->
    <div class="bg-gray-50 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Form Peminjaman Barang Multi Item</h2>

        <!-- Form Tambah Barang -->
        <form action="{{ route('tambah_barang') }}" method="POST" class="space-y-4 mb-6">
            @csrf
            <div>
                <label for="barang" class="block text-gray-700 font-semibold mb-1">Barang</label>
                <select name="barang" id="barang" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @foreach($barang as $b)
                        <option value="{{ $b->id_barang }}">{{ $b->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="jumlah" class="block text-gray-700 font-semibold mb-1">Jumlah</label>
                <input type="text" name="jumlah" id="jumlah" placeholder="Jumlah" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label for="catatan" class="block text-gray-700 font-semibold mb-1">Catatan</label>
                <textarea name="catatan" id="catatan" placeholder="Catatan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                Tambah Barang
            </button>
            @if(session('items') && count(session('items')) > 0)
    <a href="{{ route('reset_items') }}" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm mb-3 inline-block">
        Reset Keranjang
    </a>
@endif

        </form>


        <!-- Tabel Session Items -->
        @if(session('items') && count(session('items')) > 0)
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-center text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-2 py-1">ID Barang</th>
                        <th class="border border-gray-300 px-2 py-1">Jumlah</th>
                        <th class="border border-gray-300 px-2 py-1">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('items') as $item)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="border border-gray-300 px-2 py-1">{{ $item['barang_id'] }}</td>
                        <td class="border border-gray-300 px-2 py-1">{{ $item['jumlah'] }}</td>
                        <td class="border border-gray-300 px-2 py-1">{{ $item['catatan'] }}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        @endif
    </div>


    <!-- Kolom Form Simpan Semua -->
    <div class="bg-gray-50 p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold text-gray-800 text-center mb-4">Simpan Peminjaman</h2>
        <form action="{{ route('simpan_peminjaman') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="tanggal_pinjam" class="block text-gray-700 font-semibold mb-1">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label for="surat_file" class="block text-gray-700 font-semibold mb-1">Upload Surat Peminjaman</label>
                <input type="file" name="surat_file" id="surat_file" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                Simpan Peminjaman
            </button>
        </form>
            
        <div class="mt-2">
            <a href="{{ route('index.barang') }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
                Kembali
            </a>
        </div>
    </div>


</div>
@endsection
