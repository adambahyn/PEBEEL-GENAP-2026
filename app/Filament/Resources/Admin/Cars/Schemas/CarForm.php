<?php

namespace App\Filament\Resources\Admin\Cars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->directory('cars')
                    ->disk('public'),
                
                TextInput::make('brand')
                    ->required(),
                
                TextInput::make('model')
                    ->required(),
                
                Select::make('transmission')
                    ->options([
                        'manual' => 'Manual',
                        'automatic' => 'Automatic',
                    ]),
                
                TextInput::make('capacity')
                    ->numeric()
                    ->required(),

                TextInput::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->required()
                    ->default(1),
                
                TextInput::make('fuel_type')
                    ->required(),
                
                TextInput::make('price')
                    ->numeric()
                    ->prefix('IDR'),
                
                Textarea::make('description')
                    ->columnSpanFull()
                    ->required(),
                
                Section::make('Info Penyedia')
                    ->schema([
                        TextInput::make('provider_name'),
                        TextInput::make('provider_contact'),
                    ])->columns(2),
            ]);
    }
}