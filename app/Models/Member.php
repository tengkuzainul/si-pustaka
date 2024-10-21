<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $garded = ['id'];

    protected $fillable =
        [
            'nama_member',
            'alamat',
            'gender',
            'no_hp',
            'email',
        ];

    public function lends()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function itemLend()
    {
        return $this->hasMany(ItemLends::class);
    }
}
