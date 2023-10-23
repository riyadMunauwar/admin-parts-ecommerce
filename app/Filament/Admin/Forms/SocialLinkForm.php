<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class SocialLinkForm
{
    public static function make() : array
    {
        return [
            Forms\Components\Toggle::make('is_published')
                ->label('Published')
                ->default(true)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('name')
                ->nullable(),

            Forms\Components\TextInput::make('link')
                ->nullable(),

            SpatieMediaLibraryFileUpload::make('icon')
                ->imageEditor()
                ->collection('icon')
                ->visibility('public')
                ->columnSpanFull(),
        ];
    }
}
