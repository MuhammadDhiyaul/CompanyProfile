<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan updateOrCreate agar jika di-seed ulang, tidak terjadi error duplikat
        User::updateOrCreate(
            ['email'=>'smkalfithrahmalang@gmail.com'],
            [
                'name'=>'Super Admin',
                'password'=> Hash::make('@smk99@'),
                'role'=>'super_admin'
            ]
        );
    }
}
