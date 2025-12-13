@extends('layouts.main')

@section('content')
<div class="flex justify-center items-center min-h-[80vh] py-10">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">Daftar SiLab</h1>
            <p class="text-gray-500 mt-2">Buat akun untuk meminjam fasilitas lab.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" id="name" value="{{ old('nama') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Nama Anda" required>
            </div>

            <div class="mb-4">
                <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                <input type="text" name="nim" id="nim" value="{{ old('nim') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Nomor Induk Mahasiswa" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Universitas</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="email@student.trunojoyo.ac.id" required>
            </div>

            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none pr-12" placeholder="Minimal 6 karakter" required>
                    
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-blue-600 focus:outline-none">
                        <svg id="eye-open" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <svg id="eye-closed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                    </button>
                </div>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Ulangi Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none pr-12" placeholder="Ketik ulang password" required>
                </div>
                <p class="text-xs text-gray-500 mt-1">*Password harus sama persis (Case Sensitive)</p>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-500">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login di sini</a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        if (passwordInput.type === 'password') {
            // Ubah menjadi text (terlihat)
            passwordInput.type = 'text';
            confirmInput.type = 'text';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        } else {
            // Ubah kembali menjadi password (titik-titik)
            passwordInput.type = 'password';
            confirmInput.type = 'password';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        }
    }
</script>
@endsection