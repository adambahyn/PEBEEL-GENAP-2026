<?php

namespace App\Filament\Resources\Admin\Products\Schemas;

use Dom\Text;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                    ->tabs([
                        Tab::make('Product Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold'),
                                TextEntry::make('sku')
                                    ->label('SKU')
                                    ->badge()
                                    ->color('info'),
                                TextEntry::make('description')
                                    ->label('Description')
                                    ->markdown(),
                            ]),

                        // Tab 2: Menggunakan icon banknotes
                        Tab::make('Pricing & Stock')
                            ->icon('heroicon-o-banknotes')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->color('success'),

                                TextEntry::make('stock')
                                    ->label('Inventory Stock')
                                    ->badge()
                                    ->icon('heroicon-o-cube'),
                            ])->columns(2),

                        Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public')
                                    ->columnSpanFull(),
                                IconEntry::make('is_active')
                                    ->label('Active Status')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Featured Product')
                                    ->boolean(),
                            ])->columns(2),
                    ])
                    ->columnSpanFull()
                    ->vertical(),
            ]);
    }
}
