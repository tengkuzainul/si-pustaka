<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Buku extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'bukus';

    protected $fillable = [
        'isbn',
        'gambar_buku',
        'nama_buku',
        'penerbit',
        'tahun_terbit',
        'stok_buku',
        'sinopsis',
        'kategori_buku_id',
    ];

    // function boot UUID
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function kategoriBuku()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_buku_id');
    }

    public function itemLends()
    {
        return $this->hasMany(ItemLends::class, 'buku_id');
    }
}
