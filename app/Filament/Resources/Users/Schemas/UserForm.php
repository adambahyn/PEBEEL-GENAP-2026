<?php

namespace App\Filament\Resources\Users\Schemas;

use Dom\Text;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

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
                
            Select::make('role')
                ->options([
                    'admin' => 'Admin',
                    'user' => 'User',
                ])
                ->required()
                ->native(true),

            Textarea::make('alamat')
                ->label('Alamat Lengkap')
                ->rows(2),

            Select::make('verification_status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ])
                ->required()
                ->label('Status Verifikasi'),

            FileUpload::make('ktp_file')
                ->label('Foto KTP')
                ->image()
                ->directory('profiles/ktp'),

            FileUpload::make('sim_file')
                ->label('Foto SIM A')
                ->image()
                ->directory('profiles/sim'),
        ]);
    }
}
