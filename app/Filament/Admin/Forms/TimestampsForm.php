<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class TimestampsForm
{

    public static function make()
    {

        return   Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn ($record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn ($record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpanFull()
                    ->hidden(fn ($record) => $record === null);

    }
}
