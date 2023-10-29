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
            
            \App\Filament\Admin\Enums\OrderStatus::Pending->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', \App\Filament\Admin\Enums\OrderStatus::Pending->value)),

            \App\Filament\Admin\Enums\OrderStatus::Shipped->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', \App\Filament\Admin\Enums\OrderStatus::Shipped->value)),

            \App\Filament\Admin\Enums\OrderStatus::Deliverd->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', \App\Filament\Admin\Enums\OrderStatus::Deliverd->value)),

            \App\Filament\Admin\Enums\OrderStatus::Cancelled->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', \App\Filament\Admin\Enums\OrderStatus::Cancelled->value)),

            \App\Filament\Admin\Enums\OrderStatus::Refunded->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', \App\Filament\Admin\Enums\OrderStatus::Refunded->value)),

        ];
    }
    
}
