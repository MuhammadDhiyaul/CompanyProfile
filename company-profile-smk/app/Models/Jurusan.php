<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = [
        'name',
        'code',
        'slug',
        'description',
        'image',
        'head_of_department',
        'accreditation',
        'is_active',
        'sort_order',
    ];

    public function gurus(): HasMany
    {
        return $this->hasMany(Guru::class);
    }
}
