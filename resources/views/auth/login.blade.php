@extends('layouts.main')

@section('content')
<div class="flex justify-center items-center min-h-[60vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-600">Login SiLab</h1>
            <p class="text-gray-500 mt-2">Masuk untuk melakukan peminjaman barang & lab.</p>
        </div>

        <form action="#" method="POST"> @csrf
            
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Universitas</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="nim@student.trunojoyo.ac.id" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-500/30 transition duration-300 transform hover:-translate-y-0.5">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-500">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar di sini</a>
        </div>
    </div>
</div>
@endsection