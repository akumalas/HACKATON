<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Mading Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #121212; }</style>
</head>
<body class="text-gray-300 flex items-center justify-center min-h-screen p-4">
    <div class="max-w-md w-full bg-[#1e1e1e] border border-gray-800 rounded-xl shadow-2xl p-8">
        <h2 class="text-2xl font-semibold text-white mb-2 text-center tracking-wide">Login Akses</h2>
        <p class="text-gray-500 text-sm text-center mb-6">Portal Mading Kampus</p>

        @if(session('success'))
            <div class="bg-green-900/50 border border-green-700 text-green-200 px-4 py-2 rounded mb-4 text-sm">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="bg-red-900/50 border border-red-700 text-red-200 px-4 py-2 rounded mb-4 text-sm">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Username</label>
                <input type="text" name="username" required class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Password</label>
                <input type="password" name="password" required class="w-full bg-[#2a2a2a] text-white border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:border-gray-500">
            </div>
            
            <button type="submit" class="w-full bg-gray-200 hover:bg-white text-gray-900 font-semibold py-2 rounded-lg mt-2 transition duration-200">Masuk</button>
        </form>
        <p class="text-center text-sm text-gray-500 mt-4">Belum punya akun? <a href="/register" class="text-white hover:underline">Daftar di sini</a></p>
    </div>
</body>
</html>