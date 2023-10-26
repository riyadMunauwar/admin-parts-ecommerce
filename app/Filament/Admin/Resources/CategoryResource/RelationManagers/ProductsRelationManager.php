<?php

namespace App\Filament\Admin\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('search_name')
            ->columns([
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('thumbnail')
                    ->width(50)
                    ->height(50)
                    ->circular()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('search_name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            // ->recordUrl(
            //     fn (Model $record): string => route('products.edit', ['record' => $record]),
            // )
            ->reorderable('sort_order');
    }
}
