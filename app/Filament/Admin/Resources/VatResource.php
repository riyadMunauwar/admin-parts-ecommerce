<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VatResource\Pages;
use App\Filament\Admin\Resources\VatResource\RelationManagers;
use App\Models\Vat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VatResource extends Resource
{
    protected static ?string $model = Vat::class;

    protected static ?string $modelLabel = 'Tax/Vat';

    protected static ?string $pluralModelLabel = 'Taxes/Vats';

    protected static ?string $slug = 'taxes-vats';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Taxes/Vats';

    protected static ?int $navigationSort = 20;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Settings->value;
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
                //
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
            'index' => Pages\ListVats::route('/'),
            'create' => Pages\CreateVat::route('/create'),
            'edit' => Pages\EditVat::route('/{record}/edit'),
        ];
    }
}
