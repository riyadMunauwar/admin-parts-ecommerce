<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Hash;

class UserForm
{

    public static function make()
    {
        return [

            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->required()
                ->email()
                ->maxLength(255),

            Forms\Components\TextInput::make('phone')
                ->nullable()
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
