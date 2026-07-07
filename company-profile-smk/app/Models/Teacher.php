<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Teacher extends Model
{

    use HasFactory;

        protected $guarded = [];

    // protected $fillable = [
    //     'jurusan_id',
    //     'name',
    //     'nip',
    //     'position',
    //     'bio',
    //     'education',
    //     'email',
    //     'phone',
    //     'image',
    //     'is_active',
    //     'sort_order',
    // ];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }
}
