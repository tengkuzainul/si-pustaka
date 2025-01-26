<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLends extends Model
{
    use HasFactory;

    protected $table = 'item_lends';

    protected $fillable =
    [
        'qty',
        'lends_id',
        'buku_id',
    ];

    // Relasi ke tabel Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }

    // Relasi ke tabel Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'lends_id', 'id');
    }
}
