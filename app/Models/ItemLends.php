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
            'member_id',
        ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function lend()
    {
        return $this->belongsTo(Peminjaman::class, 'lends_id');
    }
}
