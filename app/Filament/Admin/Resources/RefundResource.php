<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RefundResource\Pages;
use App\Filament\Admin\Resources\RefundResource\RelationManagers;
use App\Models\Refund;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RefundResource extends Resource
{
    protected static ?string $model = Refund::class;

    protected static ?string $modelLabel = 'Refund';

    protected static ?string $pluralModelLabel = 'Refunds';

    protected static ?string $slug = 'refunds';

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Refunds';

    protected static ?int $navigationSort = 1;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Order->value;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.id')
                    ->label('Product ID')
                    ->copyable()
                    ->copyMessage('Product id copied')
                    ->copyMessageDuration(1500)
                    ->prefix('#')
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('order.id')
                    ->label('Order ID')
                    ->copyable()
                    ->copyMessage('Order id copied')
                    ->copyMessageDuration(1500)
                    ->prefix('#')
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Name')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('customer.email')
                    ->label('Email')
                    ->copyable()
                    ->copyMessage('Email copied')
                    ->copyMessageDuration(1500)
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product name')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Since')
                    ->since()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->toggleable(),

                Tables\Columns\ToggleColumn::make('is_return_accept')
                    ->label('Accept Status')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRefunds::route('/'),
            'create' => Pages\CreateRefund::route('/create'),
            'edit' => Pages\EditRefund::route('/{record}/edit'),
        ];
    }
}
