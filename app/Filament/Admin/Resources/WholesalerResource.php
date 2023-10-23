<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WholesalerResource\Pages;
use App\Filament\Admin\Resources\WholesalerResource\RelationManagers;
use App\Models\Wholesaler;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WholesalerResource extends Resource
{
    protected static ?string $model = Wholesaler::class;

    protected static ?string $modelLabel = 'Wholesaler';

    protected static ?string $pluralModelLabel = 'Wholesalers';

    protected static ?string $slug = 'wholesalers';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Wholesalers';

    protected static ?int $navigationSort = 4;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Shop->value;
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('business_name')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('business_email')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('business_contact_number')
                    ->label('Business Contact No.')
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('business_address')
                    ->label('Business Address')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('business_sales_tax')
                    ->label('Sales Tax No.')
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Account Status')
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
            'index' => Pages\ListWholesalers::route('/'),
            'create' => Pages\CreateWholesaler::route('/create'),
            'edit' => Pages\EditWholesaler::route('/{record}/edit'),
        ];
    }
}
