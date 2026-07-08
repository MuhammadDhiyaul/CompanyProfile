<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Berita;
use App\Models\SchoolProfile;
use App\Models\Galeri;
use App\Models\Prestasi;

class HomeController extends Controller
{
    // KITA TAMBAHKAN BARIS INI (Fungsi index)
    public function index()
    {
        $profil = SchoolProfile::first();

        // Mengambil data slider yang aktif, diurutkan berdasarkan sort_order
        $sliders = Slider::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        
        // Mengambil 3 berita terbaru yang statusnya dipublikasikan
        $beritas = Berita::where('is_published', true)->latest()->take(3)->get();

        // 3. Mengambil 4 Album Galeri terbaru yang aktif
        $galeris = Galeri::where('is_active', true)->latest()->take(4)->get();
        
        // 4. Mengambil 3 Prestasi terbaru
        $prestasis = Prestasi::latest()->take(3)->get();
        
        // Mengirim data tersebut ke file tampilan bernama 'welcome.blade.php'
        return view('home', compact('sliders', 'beritas', 'profil', 'galeris', 'prestasis'));
    }
    // JANGAN LUPA KURUNG KURAWAL PENUTUP INI

    // TAMBAHKAN FUNGSI BARU INI
    public function detailBerita($id)
    {
        $profil = SchoolProfile::first(); // Tetap panggil profil untuk memunculkan logo di Navbar
        
        // Cari berita berdasarkan ID-nya
        $berita = Berita::findOrFail($id);
        
        // Ambil 5 berita terbaru lainnya (selain berita yang sedang dibaca) untuk ditaruh di samping
        $beritaLain = Berita::where('is_published', true)
                            ->where('id', '!=', $id)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('berita-detail', compact('profil', 'berita', 'beritaLain'));
    }
}
