<?php

namespace App\Filament\Admin\Resources\SellingFeatureResource\Pages;

use App\Filament\Admin\Resources\SellingFeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSellingFeature extends EditRecord
{
    protected static string $resource = SellingFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
