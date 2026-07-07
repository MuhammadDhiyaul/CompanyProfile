<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Ekskul ini dibina oleh Guru siapa?
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
