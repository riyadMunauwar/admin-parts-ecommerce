<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ContactFormResource\Pages;
use App\Filament\Admin\Resources\ContactFormResource\RelationManagers;
use App\Models\ContactForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactFormResource extends Resource
{
    protected static ?string $model = ContactForm::class;

    protected static ?string $modelLabel = 'Contact Form';

    protected static ?string $pluralModelLabel = 'Contact Forms';

    protected static ?string $slug = 'contact-forms';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Contact Forms';

    protected static ?int $navigationSort = 5;


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
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('phone')
                    ->badge()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('message')
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
            'index' => Pages\ListContactForms::route('/'),
            'create' => Pages\CreateContactForm::route('/create'),
            'edit' => Pages\EditContactForm::route('/{record}/edit'),
        ];
    }
}
