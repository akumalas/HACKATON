<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembuat_id', 'judul', 'deskripsi', 'gambar_poster', 
        'tanggal_acara', 'harga', 'link_action'
    ];

    // Relasi: Event ini milik seorang User (Admin)
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'pembuat_id');
    }
}