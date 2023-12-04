<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Filament\Admin\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextInputColumn;

class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product::class;

    protected static ?string $modelLabel = 'Product';

    protected static ?string $pluralModelLabel = 'Products';

    protected static ?string $slug = 'products';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Products';

    protected static ?int $navigationSort = 2;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Shop->value;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Admin\Forms\ProductForm::make())
            ->columns([
                'md' => 1,
                'lg' => 3,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->latest())
            ->columns([
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('thumbnail')
                    ->width(100)
                    ->height(100)
                    ->circular()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('search_name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('regular_price')
                    ->label('Regular Price')
                    ->money()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('sale_price')
                    ->label('General Price')
                    ->money()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('wholesale_price')
                    ->money()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('royal_sale_price')
                    ->money()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('retailer_sale_price')
                    ->money()
                    ->searchable()
                    ->toggleable(),

                TextInputColumn::make('stock_qty')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\CheckboxColumn::make('is_featured')
                    ->label('Featured')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\CheckboxColumn::make('is_premium')
                    ->label('Premium')
                    ->searchable()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
