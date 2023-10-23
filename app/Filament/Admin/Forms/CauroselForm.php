<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CauroselForm
{
    public static function make() : array
    {
        return [
            Forms\Components\Toggle::make('is_published')
                ->label('Published')
                ->default(true)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('title')
                ->nullable(),

            Forms\Components\TextInput::make('subtitle')
                ->nullable(),

            Forms\Components\Textarea::make('text')
                ->nullable()
                ->columnSpanFull(),

            Forms\Components\TextInput::make('button_one_text')
                ->nullable(),

            Forms\Components\TextInput::make('button_one_link')
                ->nullable(),

            Forms\Components\TextInput::make('button_two_text')
                ->nullable(),

            Forms\Components\TextInput::make('button_two_link')
                ->nullable(),

            SpatieMediaLibraryFileUpload::make('image')
                ->imageEditor()
                ->collection('image')
                ->visibility('public')
                ->columnSpanFull(),
        ];
    }
}
