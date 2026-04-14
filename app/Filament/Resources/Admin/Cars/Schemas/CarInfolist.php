<?php

namespace App\Filament\Resources\Admin\Cars\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CarInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')
                    ->placeholder('-'),
                TextEntry::make('brand'),
                TextEntry::make('model'),
                TextEntry::make('capacity')
                    ->numeric(),
                TextEntry::make('transmission'),
                TextEntry::make('fuel_type'),
                TextEntry::make('price')
                    ->money(),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('provider_name'),
                TextEntry::make('provider_contact'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
