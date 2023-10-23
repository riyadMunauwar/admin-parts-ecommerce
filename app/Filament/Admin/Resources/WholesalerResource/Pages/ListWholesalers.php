<?php

namespace App\Filament\Admin\Resources\WholesalerResource\Pages;

use App\Filament\Admin\Resources\WholesalerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWholesalers extends ListRecords
{
    protected static string $resource = WholesalerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
