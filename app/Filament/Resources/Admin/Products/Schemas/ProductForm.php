<?php

namespace App\Filament\Resources\Admin\Products\Schemas;

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

                    // 🔹 STEP 1
                    Step::make('Product Info')
                        ->icon('heroicon-o-information-circle')
                        ->description('Isi informasi dasar produk')
                        ->schema([
                            Group::make([
                                TextInput::make('name')->required(),
                                TextInput::make('sku')->required(),
                            ])->columns(2),

                            MarkdownEditor::make('description')->required(),
                        ]),

                    // 🔹 STEP 2
                    Step::make('Pricing & Stock')
                        ->icon('heroicon-o-currency-dollar')
                        ->description('Isi harga dan jumlah stok')
                        ->schema([
                            TextInput::make('price')
                                ->numeric()
                                ->minValue(1)
                                ->required(),

                            TextInput::make('stock')
                                ->numeric()
                                ->required(),

                            // ✅ TYPE
                            Select::make('type')
                                ->options([
                                    'SUV' => 'SUV',
                                    'MPV' => 'MPV',
                                    'Sedan' => 'Sedan',
                                ])
                                ->required(),

                            // ✅ LOCATION
                            TextInput::make('location')
                                ->required(),
                        ]),

                    // 🔹 STEP 3
                    Step::make('Media & Status')
                        ->icon('heroicon-o-photo')
                        ->description('Upload gambar dan atur status')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('products'),

                            Checkbox::make('is_active'),

                            Checkbox::make('is_featured'),
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