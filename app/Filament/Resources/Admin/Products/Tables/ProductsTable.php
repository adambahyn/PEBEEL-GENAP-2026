<?php

namespace App\Filament\Resources\Admin\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;


class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                // 1. Tambahkan badge untuk SKU dengan warna berbeda (misal: info/biru)
                TextColumn::make('sku')
                    ->label('SKU')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->limit(50) // Membatasi tampilan deskripsi agar tabel tetap rapi
                    ->searchable()
                    ->sortable(),

                // 3. Tambahkan format harga menjadi Rp dengan formatStateUsing()
                TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn(string $state): string => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->searchable()
                    ->sortable(),

                // 2. Tambahkan icon pada Stock
                TextColumn::make('stock')
                    ->label('Stok')
                    ->icon('heroicon-o-cube') // Menambahkan ikon kubus/stok
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('image')
                    ->disk('public'),

                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        '1', 'true' => 'success',
                        '0', 'false' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => $state ? 'Aktif' : 'Non-Aktif')
                    ->sortable(),

                TextColumn::make('is_featured')
                    ->label('Unggulan')
                    ->badge()
                    ->color(fn(string $state): string => $state ? 'warning' : 'gray')
                    ->formatStateUsing(fn(string $state): string => $state ? 'Ya' : 'Tidak')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
