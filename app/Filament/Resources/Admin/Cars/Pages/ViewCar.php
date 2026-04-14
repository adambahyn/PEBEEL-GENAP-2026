<?php

namespace App\Filament\Resources\Admin\Cars\Pages;

use App\Filament\Resources\Admin\Cars\CarResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCar extends ViewRecord
{
    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
