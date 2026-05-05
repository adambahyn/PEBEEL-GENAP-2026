<?php

namespace App\Filament\Resources\Admin\Users\Schemas;

use Dom\Text;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
       return $schema->components([
            TextInput::make('name')
                ->required(),
            TextInput::make('email')
                ->email()
                ->required(),
            TextInput::make('password')
                ->password()
                ->dehydrated(fn ($state) => filled($state)),
                // ->required(fn (string $context): bool => $context === 'create'),
                
            // TAMBAHKAN KODE INI DI SINI:
            Select::make('role')
                ->options([
                    'admin' => 'Admin',
                    'user' => 'User',
                ])
                ->required()
                ->native(true), // Opsional: agar tampilan lebih modern
        ]);
    }
}
