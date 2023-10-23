<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use App\Models\Product;


class PageForm
{
    public static function make() : array
    {
        return [
            Forms\Components\Section::make('Basic')
                ->schema([

                    Forms\Components\Toggle::make('is_published')
                        ->label('Published')
                        ->default(true),

                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation !== 'create') {
                                return;
                            }

                            $set('slug', Str::slug($state));
                        }),

                    Forms\Components\TextInput::make('slug')
                        ->dehydrated()
                        ->required()
                        ->unique(Product::class, 'slug', ignoreRecord: true),



                ])
                ->collapsible(),

            Forms\Components\Section::make('Content')
                ->schema([

                    Forms\Components\RichEditor::make('content')
                        ->nullable(),

                ])
                ->collapsible(),

            Forms\Components\Section::make('SEO')
                ->schema([

                    Forms\Components\Textarea::make('meta_title')
                        ->nullable(),

                    Forms\Components\Textarea::make('meta_tags')
                        ->nullable(),

                    Forms\Components\Textarea::make('meta_description')
                        ->nullable(),

                ])
                ->collapsible(),
        ];
    }
}
