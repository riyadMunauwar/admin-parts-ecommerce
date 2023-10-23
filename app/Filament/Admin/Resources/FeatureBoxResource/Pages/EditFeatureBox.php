<?php

namespace App\Filament\Admin\Resources\FeatureBoxResource\Pages;

use App\Filament\Admin\Resources\FeatureBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeatureBox extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = FeatureBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
