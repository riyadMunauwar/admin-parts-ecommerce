<?php

namespace App\Filament\Admin\Resources\FeatureBoxResource\Pages;

use App\Filament\Admin\Resources\FeatureBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeatureBox extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = FeatureBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }

}
