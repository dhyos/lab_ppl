@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('user.dashboard') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 font-medium transition">
                &larr; Kembali ke Dashboard
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <div class="h-32 bg-gradient-to-r from-blue-500 to-blue-700"></div>
            
            <div class="px-8 pb-8">
                <div class="relative flex flex-col md:flex-row items-center md:items-end -mt-16 md:space-x-6">
                    <div class="bg-white p-2 rounded-2xl shadow-lg">
                        <div class="h-32 w-32 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 text-center md:text-left flex-1">
                        <h1 class="text-3xl font-bold text-gray-900">{{ Auth::user()->nama }}</h1>
                        <p class="text-gray-500 font-medium">{{ Auth::user()->role }}</p>
                    </div>
                </div>

                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 space-y-6">
                        <h2 class="text-xl font-bold text-gray-800 border-b pb-2">Informasi Akun</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm text-gray-500 capitalize">Nama Lengkap</label>
                                <p class="text-gray-900 font-semibold text-lg">{{ Auth::user()->nama }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 capitalize">Alamat Email</label>
                                <p class="text-gray-900 font-semibold text-lg">{{ Auth::user()->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 capitalize">Nomor HP / WhatsApp</label>
                                <p class="text-gray-900 font-semibold text-lg">{{ Auth::user()->no_hp ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h2 class="text-xl font-bold text-gray-800 border-b pb-2">Ringkasan Aktivitas</h2>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm text-gray-500">Peminjaman Lab</p>
                                <p class="text-2xl font-bold text-blue-600">{{ Auth::user()->bookings->count() }} Kali</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <p class="text-sm text-gray-500">Peminjaman Barang</p>
                                <p class="text-2xl font-bold text-green-600">{{ Auth::user()->peminjamanBarang->count() }} Kali</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-8 bg-white shadow-lg rounded-2xl p-6 border border-red-100">
            <h2 class="text-lg font-bold text-red-600 mb-4 font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                Keamanan Akun
            </h2>
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-semibold text-gray-800">Ubah Kata Sandi</p>
                    <p class="text-sm text-gray-500">Ganti password secara berkala untuk menjaga keamanan akun Anda.</p>
                </div>
                <button onclick="openPasswordModal()" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-4 py-2 rounded-lg font-bold transition duration-200 text-sm border border-red-200">
                    Ganti Password
                </button>
            </div>
        </div>
    </div>
</div>

<div id="passwordModal" 
     class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900/60 backdrop-blur-sm transition-all duration-300">
    
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
        <div class="bg-gradient-to-r from-red-500 to-pink-600 px-8 py-6 text-white relative">
            <button onclick="closePasswordModal()" class="absolute top-4 right-4 text-white/80 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white/20 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold">Keamanan Akun</h2>
                    <p class="text-red-100 text-xs">Ubah kata sandi secara berkala</p>
                </div>
            </div>
        </div>
        
        <div class="p-8">
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Password Saat Ini</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            </span>
                            <input type="password" name="current_password" 
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-red-500 focus:border-transparent transition bg-gray-50 focus:bg-white" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="h-px bg-gray-100 w-full my-2"></div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Password Baru</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input type="password" name="new_password" 
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-red-500 focus:border-transparent transition bg-gray-50 focus:bg-white" 
                                   placeholder="Minimal 8 karakter" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Ulangi Password Baru</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </span>
                            <input type="password" name="new_password_confirmation" 
                                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-red-500 focus:border-transparent transition bg-gray-50 focus:bg-white" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-col gap-3">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-red-600 to-red-500 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-red-200 hover:shadow-xl hover:from-red-700 hover:to-red-600 transition transform hover:-translate-y-0.5 active:scale-95">
                        Simpan Kata Sandi Baru
                    </button>
                    <button type="button" onclick="closePasswordModal()" 
                            class="w-full bg-white text-gray-500 font-semibold py-3 rounded-xl hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                        Batalkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openPasswordModal() {
        const modal = document.getElementById('passwordModal');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.style.opacity = '1';
        }, 10);
    }

    function closePasswordModal() {
        const modal = document.getElementById('passwordModal');
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Menutup modal jika area luar diklik
    window.onclick = function(event) {
        const modal = document.getElementById('passwordModal');
        if (event.target == modal) {
            closePasswordModal();
        }
    }
</script>
@endsection