<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class DashboardWelcomeWidget extends Widget
{
    protected string $view = 'filament.widgets.dashboard-welcome-widget';

    // Melebarkan widget dari kiri ke kanan (Full)
    protected int | string | array $columnSpan = 'full';
    
    // Tampil di urutan kedua (setelah Statistik)
    protected static ?int $sort = 2;
}
