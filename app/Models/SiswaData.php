<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaData extends Model
{
    protected $table = 'siswa_data';

    protected $guarded = ['id'];

    protected $fillable = [
        'class',
        'gender',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
