<?php

namespace App\Filament\Pages\User;

use App\Models\Product;
use Filament\Pages\Page;

class CustomerHome extends Page
{
    // protected static ?string $navigationIcon = 'heroicon-o-home';
    protected string $view = 'filament.pages.user.customer-home'; // ← hapus 'static'
    protected static ?string $title = 'Beranda';
    protected static ?string $navigationLabel = 'Beranda';
    protected static ?string $slug = '';

    protected function getViewData(): array  
    {
        return [
            'cars' => Product::latest()->take(8)->get(), 
        ];
    }
}