<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - Mading Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #121212; }</style>
</head>
<body class="text-gray-300 flex items-center justify-center min-h-screen p-4">
    <div class="max-w-md w-full bg-[#1e1e1e] border border-gray-800 rounded-xl shadow-2xl p-8">
        <h2 class="text-2xl font-semibold text-white mb-6 text-center tracking-wide">Buat Akun Baru</h2>
        
        @if(session('error'))
            <p class="bg-red-900/50 border border-red-700 text-red-200 px-4 py-2 rounded mb-4 text-sm">{{ session('error') }}</p>
        @endif

        <form method="POST" action="/register" class="space-y-4">
            @csrf <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Username</label>
                <input type="text" name="username" required class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500">
                @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Password</label>
                <input type="password" name="password" required class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Daftar Sebagai</label>
                <select name="role" class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500">
                    <option value="mahasiswa">Mahasiswa (Pengunjung)</option>
                    @if(!$adminSudahAda)
                        <option value="admin">Admin (Pembuat Acara)</option>
                    @endif
                </select>
                @if($adminSudahAda)
                    <p class="text-xs text-gray-500 mt-1">*Pendaftaran admin telah ditutup karena admin utama sudah terdaftar.</p>
                @endif
            </div>
            
            <button type="submit" class="w-full bg-gray-200 hover:bg-white text-gray-900 font-semibold py-2 rounded-lg mt-4 transition duration-200">Daftar</button>
        </form>
        <p class="text-center text-sm text-gray-500 mt-4">Sudah punya akun? <a href="/login" class="text-white hover:underline">Login di sini</a></p>
    </div>
</body>
</html>