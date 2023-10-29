<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ShipperResource\Pages;
use App\Filament\Admin\Resources\ShipperResource\RelationManagers;
use App\Models\Shipper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShipperResource extends Resource
{
    protected static ?string $model = Shipper::class;

    protected static ?string $modelLabel = 'Shipper';

    protected static ?string $pluralModelLabel = 'Shippers';

    protected static ?string $slug = 'shippers';

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $recordTitleAttribute = 'shipper';

    protected static ?string $navigationLabel = 'Shippers';

    protected static ?int $navigationSort = 21;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Settings->value;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Admin\Forms\ShipperForm::make())
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('shipper')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('notes')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('delivery_cost')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Published')
                    ->toggleable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListShippers::route('/'),
            // 'create' => Pages\CreateShipper::route('/create'),
            // 'edit' => Pages\EditShipper::route('/{record}/edit'),
        ];
    }    
}
