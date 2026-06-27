<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'name', 'about', 'vision', 'mission', 'address', 
        'phone', 'email', 'logo', 'struktur_org_image'
    ];
}
