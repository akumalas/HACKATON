<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Online Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #121212; }</style>
</head>
<body class="text-gray-300 min-h-screen flex flex-col">

    <nav class="bg-[#1a1a1a] border-b border-gray-800 p-4 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-white tracking-widest uppercase">MADING<span class="text-gray-500">KAMPUS</span></h1>
            
            <div class="space-x-4 flex items-center">
                @auth
                    <span class="text-sm text-gray-400 mr-4">Halo, {{ auth()->user()->nama_lengkap }}</span>
                    
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/tambah-poster" class="bg-gray-200 text-gray-900 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white transition">Upload Poster</a>
                    @endif
                    
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-400 hover:text-red-300">Logout</button>
                    </form>
                @else
                    <a href="/login" class="text-sm text-white hover:text-gray-300">Login</a>
                    <a href="/register" class="bg-gray-200 text-gray-900 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-white transition">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-6xl mx-auto p-6 w-full mt-6">
        
        @if(session('error'))
            <div class="bg-red-900/50 border border-red-700 text-red-200 px-4 py-3 rounded mb-6 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                
                @foreach($events as $event)
                    <div class="bg-[#1e1e1e] border border-gray-800 rounded-xl overflow-hidden hover:border-gray-600 transition duration-300 shadow-lg group">
                        
                        <div class="h-64 w-full overflow-hidden bg-black relative">
                            <img src="{{ asset('storage/' . $event->gambar_poster) }}" alt="{{ $event->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100">
                            @if($event->harga == 0)
                                <span class="absolute top-2 right-2 bg-green-900/80 text-green-300 text-xs px-2 py-1 rounded border border-green-700">GRATIS</span>
                            @else
                                <span class="absolute top-2 right-2 bg-blue-900/80 text-blue-300 text-xs px-2 py-1 rounded border border-blue-700">Rp {{ number_format($event->harga, 0, ',', '.') }}</span>
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="text-lg font-bold text-white mb-1 truncate">{{ $event->judul }}</h3>
                            <p class="text-xs text-gray-500 mb-4">📅 {{ \Carbon\Carbon::parse($event->tanggal_acara)->format('d M Y') }}</p>
                            
                            <a href="/event/{{ $event->id }}" class="block w-full text-center bg-[#2a2a2a] hover:bg-gray-700 text-white text-sm py-2 rounded transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <div class="flex flex-col items-center justify-center text-center mt-20">
                <p class="text-gray-500 text-lg mb-2">Mading masih kosong.</p>
                <p class="text-gray-600 text-sm">Belum ada acara kampus yang diunggah.</p>
            </div>
        @endif
    </main>

</body>
</html>