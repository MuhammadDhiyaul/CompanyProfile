<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolProfile;

class SchoolProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan updateOrCreate untuk mengunci di ID 1
        SchoolProfile::updateOrCreate(
            ['id' => 1], 
            [
                'name' => 'SMK Al Fithrah Malang',
                'about' => 'Sekolah menengah kejuruan berbasis Alam dan Riset.',
                'vision' => 'Mengedepankan Akhlakul Karimah dan Prestasi.',
                'mission' => 'Mengedepankan Akhlakul Karimah dan Prestasi.',
                'address' => 'Jl. Probolinggo 99 Penarukan - Kepanjen',
                'phone' => '081910441609',
                'email' => 'smk.alfithrah@gmail.com',
            ]
        );
    }
}
