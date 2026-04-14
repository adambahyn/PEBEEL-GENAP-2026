<?php

namespace App\Filament\Resources\Admin\Cars\Tables;

use Filament\Tables;
use Filament\Tables\Table;

// Columns
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

// Actions
use Filament\Tables\Actions\Actions;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\ActionGroup;

// Bulk Actions
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class CarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('🖼️ Foto'),

                TextColumn::make('brand')
                    ->label('🚘 Brand')
                    ->searchable()
                    ->sortable(), // Mengaktifkan asc/desc

                TextColumn::make('model')
                    ->label('🏷️ Model')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('capacity')
                    ->label('👥 Kapasitas')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('transmission')
                    ->label('⚙️ Transmisi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fuel_type')
                    ->label('⛽ Bahan Bakar')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('💰 Harga')
                    ->money('idr')
                    ->sortable(),

                TextColumn::make('provider_name')
                    ->label('👤 Penyedia')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('provider_contact')
                    ->label('📞 Kontak')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('📅 Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Menambahkan tombol aksi di setiap baris
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                ])->icon('heroicon-m-ellipsis-vertical')
                ->tooltip('Aksi'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}