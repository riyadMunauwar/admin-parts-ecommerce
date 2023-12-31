<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Order;
use App\Filament\Admin\Resources\OrderResource;


class LatestOrders extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    // protected static ?int $sort = 2;


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

            Tables\Columns\TextColumn::make('user.name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('payment_status')
                ->badge(),

            Tables\Columns\TextColumn::make('status')
                ->badge(),

            Tables\Columns\TextColumn::make('total_product_price')
                ->searchable()
                ->money()
                ->sortable(),

            Tables\Columns\TextColumn::make('shipping_cost')
                ->label('Shipping cost')
                ->searchable()
                ->money()
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\Action::make('open')
                ->url(fn (Order $record): string => OrderResource::getUrl('edit', ['record' => $record])),
        ]);
    }
}
