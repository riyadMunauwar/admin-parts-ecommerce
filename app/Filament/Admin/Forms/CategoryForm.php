<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CategoryForm
{
    public static function make() : array
    {
        return [

        Forms\Components\Group::make()
            ->schema([

            Forms\Components\Section::make('Basic')
                ->schema([

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

            Forms\Components\Section::make('Description')
                ->schema([

                    Forms\Components\RichEditor::make('description')
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

            ])
            ->columnSpan([
                'md' => 1,
                'lg' => 2,
            ]),



        Forms\Components\Group::make()
            ->schema([
                Forms\Components\Section::make('Status')
                ->schema([

                    Forms\Components\Toggle::make('is_published')
                        ->default(true),

                    Forms\Components\TextInput::make('order')
                        ->label('Showing Position')
                        ->numeric()
                        ->nullable(),

                    Forms\Components\Select::make('parent_id')
                        ->label('Parent')
                        ->getSearchResultsUsing(fn (string $search): array => Category::where('search_name', 'like', "%{$search}%")->limit(12)->pluck('search_name', 'id')->toArray())
                        ->getOptionLabelUsing(fn ($value): ?string => Category::find($value)?->search_name)
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    SpatieMediaLibraryFileUpload::make('icon')
                        ->imageEditor()
                        ->collection('icon')
                        ->visibility('public'),

                ])
                ->collapsible()

            ])
            ->columnSpan([
                'lg' => 1,
            ]),

        ];
    }
}
