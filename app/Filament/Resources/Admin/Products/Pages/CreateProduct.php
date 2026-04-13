<?php

namespace App\Filament\Resources\Admin\Products\Pages;

use App\Filament\Resources\Admin\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function getFormActions(): array
    {
        return [];
    }
}
