<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeri extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Memberitahu Laravel bahwa kolom 'images' adalah array
    protected $casts = [
        'images' => 'array',
    ];
}
