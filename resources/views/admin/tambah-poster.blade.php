<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Poster - Mading Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #121212; }</style>
</head>
<body class="text-gray-300 min-h-screen p-6">
    <div class="max-w-2xl mx-auto bg-[#1e1e1e] border border-gray-800 rounded-xl shadow-2xl p-8 mt-10">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white">Unggah Acara Baru</h2>
            <a href="/" class="text-sm text-gray-400 hover:text-white">← Kembali ke Mading</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-900/50 border border-red-700 text-red-200 px-4 py-3 rounded mb-6 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/tambah-poster" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Judul Acara</label>
                <input type="text" name="judul" value="{{ old('judul') }}" required class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Deskripsi / Info Detail</label>
                <textarea name="deskripsi" rows="4" required class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Tanggal Acara</label>
                    <input type="date" name="tanggal_acara" value="{{ old('tanggal_acara') }}" required class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500 color-scheme-dark">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Harga Tiket (Isi 0 jika Gratis)</label>
                    <input type="number" name="harga" value="{{ old('harga', 0) }}" min="0" required class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">File Poster (JPG/PNG, Max: 2MB)</label>
                <input type="file" name="gambar_poster" accept="image/*" required class="w-full bg-[#2a2a2a] text-gray-400 border border-gray-700 rounded-lg px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-700 file:text-white hover:file:bg-gray-600 focus:outline-none focus:border-gray-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-lg mt-6 transition duration-200">
                Publikasikan Poster
            </button>
        </form>
    </div>
</body>
</html>