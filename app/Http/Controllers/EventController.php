<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // Menampilkan halaman utama (Feed Mading)
    public function index()
    {
        // Mengambil semua event, urut dari yang paling baru
        $events = Event::latest()->get();
        return view('index', compact('events'));
    }

    // Menampilkan form tambah poster (Khusus Admin)
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak. Anda bukan Admin.');
        }
        return view('admin.tambah-poster');
    }

    // Proses Simpan Poster Baru
    public function store(Request $request)
    {
        // 1. Keamanan ekstra: Pastikan hanya admin yang bisa post
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        // 2. Validasi input dari form
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'tanggal_acara' => 'required|date',
            'harga' => 'required|numeric|min:0',
            // Validasi khusus gambar: harus file gambar & maksimal 2MB
            'gambar_poster' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // 3. Proses Upload Gambar
        // Gambar akan disimpan di folder: storage/app/public/posters
        $imagePath = $request->file('gambar_poster')->store('posters', 'public');

        // 4. Simpan semua data ke Database
        Event::create([
            'pembuat_id' => auth()->user()->id, // ID admin yang sedang login
            'judul' => $validatedData['judul'],
            'deskripsi' => $validatedData['deskripsi'],
            'gambar_poster' => $imagePath, // Menyimpan lokasi path gambarnya saja
            'tanggal_acara' => $validatedData['tanggal_acara'],
            'harga' => $validatedData['harga'],
            'link_action' => null // Ini bisa diisi nanti kalau butuh link eksternal
        ]);

        // 5. Kembalikan ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Poster acara berhasil diunggah!');
    }
}