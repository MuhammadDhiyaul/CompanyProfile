<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'npsn',
        'nss',
        'status',
        'accreditation',
        'principal',

        'email',
        'phone',
        'whatsapp',
        'website',

        'address',
        'postal_code',
        'google_maps',

        'history',
        'vision',
        'mission',

        'logo',
        'favicon',
        'hero_image',

        'facebook',
        'instagram',
        'youtube',
        'tiktok'
    ];
}
