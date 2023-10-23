<?php

namespace App\Filament\Admin\Resources\WholesalerResource\Pages;

use App\Filament\Admin\Resources\WholesalerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWholesaler extends EditRecord
{
    protected static string $resource = WholesalerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
