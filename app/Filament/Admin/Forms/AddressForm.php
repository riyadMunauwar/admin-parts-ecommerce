<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use App\Models\User;


class AddressForm
{

    public static function make()
    {
        return [
            Forms\Components\TextInput::make('first_name')
                ->nullable(),

            Forms\Components\TextInput::make('last_name')
                ->nullable(),


            Forms\Components\TextInput::make('street_1')
                ->nullable(),

            Forms\Components\TextInput::make('street_2')
                ->nullable(),

            Forms\Components\TextInput::make('city')
                ->nullable(),

            Forms\Components\TextInput::make('zip')
                ->nullable(),

            Forms\Components\TextInput::make('state')
                ->nullable(),

            Forms\Components\TextInput::make('country')
                ->nullable(),

            Forms\Components\TextInput::make('email')
                ->nullable(),

            Forms\Components\TextInput::make('phone')
                ->nullable(),
        ];
    }
}
