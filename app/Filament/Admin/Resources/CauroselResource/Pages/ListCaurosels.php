<?php

namespace App\Filament\Admin\Resources\CauroselResource\Pages;

use App\Filament\Admin\Resources\CauroselResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaurosels extends ListRecords
{
    protected static string $resource = CauroselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
