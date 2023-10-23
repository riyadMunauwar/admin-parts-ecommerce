<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CategoryResource\Pages;
use App\Filament\Admin\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Category::class;

    protected static ?string $modelLabel = 'Category';

    protected static ?string $pluralModelLabel = 'Categories';

    protected static ?string $slug = 'categories';

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Categories';

    protected static ?int $navigationSort = 1;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Shop->value;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Admin\Forms\CategoryForm::make())
            ->columns([
                'md' => 1,
                'lg' => 3,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('icon')
                    ->collection('icon')
                    ->width(50)
                    ->height(50)
                    ->circular()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('search_name')
                    ->label('Name')
                    ->searchable()
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('children.name')
                    ->label('Children')
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Parent')
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\CheckboxColumn::make('is_featured')
                    ->label('Featured')
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
                ]),
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
            RelationManagers\ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
