<?php

namespace App\Filament\Admin\Resources\FeatureBoxResource\Pages;

use App\Filament\Admin\Resources\FeatureBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeatureBoxes extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = FeatureBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
