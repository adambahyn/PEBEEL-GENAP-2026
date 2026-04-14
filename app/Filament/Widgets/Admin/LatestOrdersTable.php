<?php

namespace App\Filament\Widgets\Admin;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
// use App\Models\Order; // Pastikan model transaksi Anda di-import

class LatestOrdersTable extends BaseWidget
{
    protected int | string | array $columnSpan = 'full'; // Agar tabel selebar layar penuh
    protected static ?string $heading = 'Pesanan Terbaru';

    public function table(Table $table): Table
    {
        return $table
            // ->query(Order::query()->latest()->limit(5)) // Gunakan query ini jika model Order sudah ada
            ->query(\App\Models\Product::query()->latest()->limit(5)) // Placeholder sementara menggunakan Product
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Pelanggan / Mobil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pesanan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Total Pembayaran')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('status') // Misal: Lunas, Pending
                    ->badge()
                    ->color('success'), 
            ]);
    }
}