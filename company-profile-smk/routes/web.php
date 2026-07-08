<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IdCardController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Rute untuk halaman utama frontend
Route::get('/', [HomeController::class, 'index']);
// Rute untuk melihat/mencetak ID Card Guru berdasarkan NIP
Route::get('/id-card/guru/{nip}', [IdCardController::class, 'cetakGuru']);
// Rute untuk Layar Scanner Utama
Route::get('/scanner', function () {
    return view('scanner');
});
// Rute untuk halaman detail berita
Route::get('/berita/{id}', [HomeController::class, 'detailBerita']);
