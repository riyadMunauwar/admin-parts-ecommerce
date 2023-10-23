<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FeatureBoxResource\Pages;
use App\Filament\Admin\Resources\FeatureBoxResource\RelationManagers;
use App\Models\FeatureBox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;

class FeatureBoxResource extends Resource
{
    use Translatable;

    protected static ?string $model = FeatureBox::class;

    protected static ?string $modelLabel = 'Feature Box';

    protected static ?string $pluralModelLabel = 'Feature Boxes';

    protected static ?string $slug = 'feature-boxes';

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    protected static ?string $navigationLabel = 'Feature Boxes';

    protected static ?int $navigationSort = 12;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Appearance->value;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Admin\Forms\FeatureBoxForm::make());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sup_title')
                    ->searchable()
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('title')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('sub_title')
                    ->searchable()
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('button_text')
                    ->badge()
                    ->searchable()
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('button_link')
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Published')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ListFeatureBoxes::route('/'),
            // 'create' => Pages\CreateFeatureBox::route('/create'),
            // 'edit' => Pages\EditFeatureBox::route('/{record}/edit'),
        ];
    }
}
