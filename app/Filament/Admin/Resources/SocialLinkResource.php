<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SocialLinkResource\Pages;
use App\Filament\Admin\Resources\SocialLinkResource\RelationManagers;
use App\Models\SocialLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static ?string $modelLabel = 'Social Link';

    protected static ?string $pluralModelLabel = 'Social Links';

    protected static ?string $slug = 'social-links';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';

    protected static ?string $navigationLabel = 'Social Links';

    protected static ?int $navigationSort = 11;


    public static function getNavigationGroup(): string
    {
        return \App\Filament\Admin\Enums\AdminNavigationGroup::Appearance->value;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Admin\Forms\SocialLinkForm::make());
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

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->toggleable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('link')
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListSocialLinks::route('/'),
            // 'create' => Pages\CreateSocialLink::route('/create'),
            // 'edit' => Pages\EditSocialLink::route('/{record}/edit'),
        ];
    }
}
