<?php

namespace App\Filament\Admin\Resources\VatResource\Pages;

use App\Filament\Admin\Resources\VatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVat extends EditRecord
{
    protected static string $resource = VatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
