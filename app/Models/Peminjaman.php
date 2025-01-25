<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'lends';

    protected $guarded = ['id'];

    protected $fillable =
    [
        'number',
        'lend_date',
        'return_date',
        'siswa_id',
    ];

    public function siswaID()
    {
        return $this->belongsTo(User::class, 'siswa_id', 'id');
    }

    public function itemLend()
    {
        return $this->hasMany(ItemLends::class, 'lends_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}
