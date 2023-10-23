<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SubscriberResource\Pages;
use App\Filament\Admin\Resources\SubscriberResource\RelationManagers;
use App\Models\Subscriber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriberResource extends Resource
{
    protected static ?string $model = Subscriber::class;


    protected static ?string $modelLabel = 'Subscriber';

    protected static ?string $pluralModelLabel = 'Subscribers';

    protected static ?string $slug = 'subscriber';

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Subscribers';

    protected static ?int $navigationSort = 6;


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

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),

                ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSubscribers::route('/'),
            'create' => Pages\CreateSubscriber::route('/create'),
            'edit' => Pages\EditSubscriber::route('/{record}/edit'),
        ];
    }
}
