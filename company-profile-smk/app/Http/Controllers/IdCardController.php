<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IdCardController extends Controller
{
    // Fungsi untuk menampilkan ID Card Guru
    public function cetakGuru($nip)
    {
        // Mencari guru berdasarkan NIP
        $teacher = Teacher::where('nip', $nip)->firstOrFail();
        
        // Membuat QR Code yang berisi NIP guru tersebut (ukuran 150x150 pixel)
        $qrCode = QrCode::size(150)->generate($teacher->nip);

        return view('id-card', compact('teacher', 'qrCode'));
    }
}
