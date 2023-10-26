<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Order;
use App\Filament\Admin\Resources\OrderResorce;

class LatestOrders extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
        ->query(OrderResource::getEloquentQuery())
        ->defaultPaginationPageOption(5)
        ->defaultSort('created_at', 'desc')
        ->columns([
            Tables\Columns\TextColumn::make('created_at')
                ->label('Order Date')
                ->date()
                ->sortable(),

            Tables\Columns\TextColumn::make('customer.name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('payment_status')
                ->badge(),

            Tables\Columns\TextColumn::make('order_status')
                ->badge(),

            Tables\Columns\TextColumn::make('total_order_price')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('shipping_cost')
                ->label('Shipping cost')
                ->searchable()
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\Action::make('open')
                ->url(fn (Order $record): string => OrderResource::getUrl('edit', ['record' => $record])),
        ]);
    }
}
