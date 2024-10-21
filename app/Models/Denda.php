<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;

    protected $table = 'dendas';

    protected $guarded = ['id'];

    protected $fillable = ['jumlah_denda'];
}
