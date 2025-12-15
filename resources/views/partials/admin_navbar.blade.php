<nav class="bg-slate-900 text-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-blue-400 flex items-center gap-2">
                SiLab <span class="text-xs bg-blue-600 text-white px-2 py-0.5 rounded">ADMIN</span>
            </a>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-400 font-medium transition">Dashboard</a>
                <a href="{{ route('admin.labs') }}" class="hover:text-blue-400 font-medium transition">Kelola Lab</a>
                <a href="{{ route('admin.barang') }}" class="hover:text-blue-400 font-medium transition">Kelola Barang</a>
                <a href="{{ route('admin.booking.index') }}" class="hover:text-blue-400 font-medium transition">Peminjaman</a>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-sm font-semibold">{{ Auth::user()->nama }}</span>
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:font-bold transition cursor-pointer">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>