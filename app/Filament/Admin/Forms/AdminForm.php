<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Hash;

class AdminForm
{

    public static function make()
    {
        return [

            Forms\Components\Checkbox::make('is_admin')
                ->required()
                ->default(true),

            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $operation): bool => $operation === 'create'),


            \App\Filament\Admin\Forms\TimestampsForm::make(),

        ];
    }
}
