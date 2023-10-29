<?php

namespace App\Filament\Admin\Resources\OrderResource\Pages;

use App\Filament\Admin\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),

            \App\Filament\Admin\Enums\OrderStatus::New->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', \App\Filament\Admin\Enums\OrderStatus::New->value)),
                

        ];
    }
    
}
