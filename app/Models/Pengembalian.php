<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'return';

    protected $guarded = ['id'];

    protected $fillable = [
        'no_peminjaman',
        'tanggal_pengembalian',
        'denda',
        'peminjaman_id',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
}
