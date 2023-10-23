<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CauroselResource\Pages;
use App\Filament\Admin\Resources\CauroselResource\RelationManagers;
use App\Models\Caurosel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CauroselResource extends Resource
{
    protected static ?string $model = Caurosel::class;

    protected static ?string $modelLabel = 'Caurosel';

    protected static ?string $pluralModelLabel = 'Caurosels';

    protected static ?string $slug = 'caurosel';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Caurosels';

    protected static ?int $navigationSort = 14;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Appearance->value;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Admin\Forms\CauroselForm::make());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->width(700)
                    ->height(300)
                    ->toggleable(),

                Tables\Columns\CheckboxColumn::make('is_published')
                    ->label('Published')
                    ->searchable()
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
            'index' => Pages\ListCaurosels::route('/'),
            // 'create' => Pages\CreateCaurosel::route('/create'),
            // 'edit' => Pages\EditCaurosel::route('/{record}/edit'),
        ];
    }
}
