<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class FeatureBoxForm
{
    public static function make() : array
    {
        return [

            Forms\Components\Toggle::make('is_published')
                ->label('Published')
                ->default(true)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('sup_title')
                ->nullable(),

            Forms\Components\TextInput::make('title')
                ->nullable(),

            Forms\Components\Textarea::make('sub_title')
                ->nullable()
                ->columnSpanFull(),

            Forms\Components\TextInput::make('button_text')
                ->nullable(),

            Forms\Components\TextInput::make('button_link')
                ->nullable(),

            SpatieMediaLibraryFileUpload::make('image')
                ->imageEditor()
                ->collection('image')
                ->visibility('public')
                ->columnSpanFull(),
        ];
    }
}
