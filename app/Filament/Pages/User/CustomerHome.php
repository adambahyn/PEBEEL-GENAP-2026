<?php

namespace App\Filament\Pages\User;

use App\Models\Product;
use Filament\Pages\Page;

class CustomerHome extends Page
{
    // protected static ?string $navigationIcon = 'heroicon-o-home';

    // ✅ Non-static — wajib di Filament v3 (static akan error "Cannot redeclare non static")
    protected string $view = 'Home.index';

    protected static ?string $title = 'Beranda';
    protected static ?string $navigationLabel = 'Beranda';

    // ✅ Slug kosong → halaman utama panel user (localhost:8000/customer)
    protected static ?string $slug = '';

    // ✅ Urutkan di navigasi paling atas
    protected static ?int $navigationSort = 1;

    protected function getViewData(): array
    {
        return [
            // Ambil 8 mobil aktif terbaru untuk ditampilkan di beranda
            'cars' => Product::where('is_active', true)->latest()->take(8)->get(),
        ];
    }
}
