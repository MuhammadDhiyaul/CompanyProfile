<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Teacher; // Memanggil tabel Teacher
use App\Models\Berita;  // Memanggil tabel Berita
use App\Models\Galeri;  // Memanggil tabel Galeri

class StatsOverview extends BaseWidget
{
    // protected function getStats(): array
    // {
    //     return [
    //         //
    //     ];
    // }

    // Mengatur urutan agar tampil paling atas di dashboard
    protected static ?int $sort = 1; 

    protected function getStats(): array
    {
        return [
            // Kartu 1: Menghitung total semua baris di tabel Teacher
            Stat::make('Total Pendidik', Teacher::count())
                ->description('Guru & Staf Terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
                
            // Kartu 2: Menghitung total Berita yang statusnya 'published'
            Stat::make('Berita Aktif', Berita::where('is_published', true)->count())
                ->description('Artikel tayang di web')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary'),
                
            // Kartu 3: Menghitung total album Galeri
            Stat::make('Album Galeri', Galeri::count())
                ->description('Dokumentasi Kegiatan')
                ->descriptionIcon('heroicon-m-photo')
                ->color('warning'),
        ];
    }

}
