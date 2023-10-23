<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SellingFeatureResource\Pages;
use App\Filament\Admin\Resources\SellingFeatureResource\RelationManagers;
use App\Models\SellingFeature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;

class SellingFeatureResource extends Resource
{
    use Translatable;

    protected static ?string $model = SellingFeature::class;

    protected static ?string $modelLabel = 'Selling Feature Banner';

    protected static ?string $pluralModelLabel = 'Selling Feature Banners';

    protected static ?string $slug = 'selling-feature-banners';

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = 'Selling Features';

    protected static ?int $navigationSort = 10;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Appearance->value;
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
            'index' => Pages\ListSellingFeatures::route('/'),
            'create' => Pages\CreateSellingFeature::route('/create'),
            'edit' => Pages\EditSellingFeature::route('/{record}/edit'),
        ];
    }
}
