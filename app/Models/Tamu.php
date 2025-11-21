<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    protected $table = 'tamu';

    protected $fillable = [
        'tanggal_berkunjung',
        'nama',
        'no_telp',
        'tujuan',
        'sub_tujuan',
    ];
}
