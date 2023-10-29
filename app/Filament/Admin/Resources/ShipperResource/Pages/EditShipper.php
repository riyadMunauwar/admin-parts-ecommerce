<?php

namespace App\Filament\Admin\Resources\ShipperResource\Pages;

use App\Filament\Admin\Resources\ShipperResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShipper extends EditRecord
{
    protected static string $resource = ShipperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
