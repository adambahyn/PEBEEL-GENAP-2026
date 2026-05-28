<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Actions\Action;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    Step::make('Product Info')
                        ->icon('heroicon-o-information-circle')
                        ->description('Isi informasi dasar produk')
                        ->schema([
                            Group::make([
                                TextInput::make('name')->required(),
                                TextInput::make('sku')->required()->unique(ignoreRecord: true),
                            ])->columns(2),

                            Group::make([
                                TextInput::make('brand')->required(),
                                TextInput::make('model')->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description')->required(),
                        ]),


                    Step::make('Pricing & Stock')
                        ->icon('heroicon-o-currency-dollar')
                        ->description('Isi harga dan jumlah stok')
                        ->schema([
                            Group::make([
                                TextInput::make('price')
                                    ->numeric()
                                    ->minValue(1)
                                    ->required(),
                                TextInput::make('stock')
                                    ->numeric()
                                    ->default(1)
                                    ->readOnly()
                                    ->required(),
                            ])->columns(2),
                            Group::make([
                                Select::make('type')
                                    ->options([
                                        'SUV' => 'SUV',
                                        'MPV' => 'MPV',
                                        'Sedan' => 'Sedan',
                                    ])->required(),
                                TextInput::make('capacity')
                                    ->label('Kapasitas (Penumpang)')
                                    ->numeric()
                                    ->required(),
                                Select::make('transmission')
                                    ->label('Transmisi')
                                    ->options([
                                        'Automatic' => 'Automatic',
                                        'Manual' => 'Manual',
                                    ])->required(),
                                Select::make('fuel_type')
                                    ->label('Bahan Bakar')
                                    ->options([
                                        'Bensin' => 'Bensin',
                                        'Diesel' => 'Diesel',
                                        'Listrik' => 'Listrik',
                                    ])->required(),
                            ])->columns(2),
                            TextInput::make('location')
                                ->required(),
                        ]),

                    Step::make('Media & Status')
                        ->icon('heroicon-o-photo')
                        ->description('Upload gambar dan atur status')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('products'),
                            Checkbox::make('is_active')->label('Aktif'),
                            Checkbox::make('is_booked')->label('Booked / Disewa'),
                            Checkbox::make('is_featured')->label('Produk Unggulan'),
                        ]),

                ])
                    ->columnSpanFull()
                    ->submitAction(
                        Action::make('save')
                            ->label('Save Product')
                            ->color('primary')
                            ->submit('save')
                    ),
            ]);
    }
}
