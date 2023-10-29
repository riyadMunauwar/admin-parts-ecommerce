<?php

namespace App\Filament\Admin\Resources\ShipperResource\Pages;

use App\Filament\Admin\Resources\ShipperResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShippers extends ListRecords
{
    protected static string $resource = ShipperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
