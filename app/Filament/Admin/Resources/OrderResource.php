<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Filament\Admin\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $modelLabel = 'Order';

    protected static ?string $pluralModelLabel = 'Orders';

    protected static ?string $slug = 'orders';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Orders';

    protected static ?int $navigationSort = 0;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Order->value;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Admin\Forms\NewOrderForm::make())->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->copyable()
                    ->copyMessage('Order id copied')
                    ->copyMessageDuration(1500)
                    ->prefix('#')
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('address.state')
                    ->label('State/City')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->copyable()
                    ->copyMessage('Email copied')
                    ->copyMessageDuration(1500)
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('total_product_price')
                    ->label('Total')
                    ->money()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('shipping_cost')
                    ->label('Shipping Price')
                    ->money()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('order_date')
                    ->label('Since')
                    ->since()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Order Status')
                    ->badge()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrderItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
