<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="{{ route('user.dashboard') }}" class="text-2xl font-bold text-blue-600 flex items-center gap-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                SiLab
            </a>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Dashboard</a>
<a href="{{ route('booking.create') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">
                    Ajukan Peminjaman
                </a>

                <a href="{{ route('booking.calendar') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Jadwal</a>
                
                <a href="{{ route('booking.history') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">Riwayat</a>
            </div>

            <div>
                @auth
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-gray-700 font-semibold hover:text-blue-600 transition focus:outline-none">
                            <span>Hai, {{ Auth::user()->nama }}</span> <svg class="w-4 h-4 transition transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right z-50">
                            <div class="py-2">
                                <a href="{{ route('profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    Profil Saya
                                </a>
                                
                                <div class="border-t border-gray-100 my-1"></div>
                                
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:font-bold transition">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>