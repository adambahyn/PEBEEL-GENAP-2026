<?php

namespace App\Filament\Widgets\Admin;

use App\Models\Product; // Model Mobil Anda
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pesanan', '192') // Ganti dengan Model Order/Transaksi Anda nanti
                ->description('32 peningkatan dari bulan lalu')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Pendapatan Bulan Ini', 'Rp 45.000.000') // Ganti dengan logic sum() dari tabel transaksi
                ->description('7% peningkatan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Total Mobil', Product::count()) // Menghitung total mobil otomatis
                ->description('Mobil terdaftar di sistem')
                ->color('info'),
        ];
    }
}