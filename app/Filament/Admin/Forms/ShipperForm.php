<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class ShipperForm
{
    public static function make() : array
    {
        return [
            Forms\Components\Toggle::make('is_published')
                ->label('Published')
                ->default(true)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('shipper')
                ->nullable(),

            Forms\Components\TextInput::make('slug')
                ->nullable(),

            Forms\Components\Textarea::make('notes')
                ->nullable(),

            Forms\Components\Textarea::make('delivery_cost')
                ->numeric()
                ->nullable(),


        ];
    }
}
