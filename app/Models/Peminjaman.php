<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'lends';

    protected $fillable = [
        'number',
        'lend_date',
        'return_date',
        'siswa_id',
    ];

    // Relasi ke tabel User sebagai siswa
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id', 'id');
    }

    // Relasi ke tabel ItemLends
    public function itemLend()
    {
        return $this->hasMany(ItemLends::class, 'lends_id', 'id');
    }

    // Relasi ke tabel Pengembalian
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id', 'id');
    }
}
