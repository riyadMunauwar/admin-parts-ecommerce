<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductForm
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


                    Forms\Components\Group::make()
                        ->schema([

                            Forms\Components\TextInput::make('regular_price')
                                ->required()
                                ->numeric(),

                            Forms\Components\TextInput::make('sale_price')
                                ->required()
                                ->numeric(),

                            Forms\Components\TextInput::make('retailer_sale_price')
                                ->nullable()
                                ->numeric(),

                            Forms\Components\TextInput::make('royal_sale_price')
                                ->nullable()
                                ->numeric(),

                            Forms\Components\TextInput::make('wholesale_price')
                                ->nullable()
                                ->numeric(),

                            Forms\Components\TextInput::make('stock_qty')
                                ->required()
                                ->numeric(),

                            Forms\Components\TextInput::make('height')
                                ->nullable()
                                ->numeric(),

                            Forms\Components\TextInput::make('width')
                                ->nullable()
                                ->numeric(),

                            Forms\Components\TextInput::make('length')
                                ->nullable()
                                ->numeric(),

                            Forms\Components\TextInput::make('weight')
                                ->nullable()
                                ->numeric(),

                            Forms\Components\TextInput::make('sku'),

                            Forms\Components\TextInput::make('color')
                                ->nullable(),

                            Forms\Components\TextInput::make('color_code')
                                ->nullable(),

                        ])->columns(3),

                ])
                ->collapsible(),

            Forms\Components\Section::make('Description')
                ->schema([

                    Forms\Components\RichEditor::make('compatibility')
                        ->nullable(),

                    Forms\Components\RichEditor::make('features')
                        ->nullable(),

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



                    // SpatieMediaLibraryFileUpload::make('thumbnail')
                    //     ->collection('image')
                    //     ->conversion('optimized')
                    //     ->disk('media-library')
                    //     ->downloadable()
                    //     ->imageCropAspectRatio('16:9')
                    //     ->imageEditor()
                    //     ->imageResizeMode('cover')
                    //     ->imageResizeTargetHeight('1080')
                    //     ->imageResizeTargetWidth('1920')
                    //     ->visibility('public'),

                    Forms\Components\Toggle::make('is_published')
                        ->default(true),

                    Forms\Components\Toggle::make('is_premium'),

                    Forms\Components\Toggle::make('is_featured'),

                    Forms\Components\Toggle::make('is_recommendation_active'),

                    Forms\Components\Toggle::make('is_random_recommendation'),






                    Forms\Components\Select::make('vat_id')
                        ->nullable()
                        ->relationship('vat', 'vat_rate')
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->vat_rate} %")
                        ->preload()
                        ->native(false),

                    Forms\Components\TextInput::make('youtube_video_id')
                        ->nullable(),


                    SpatieMediaLibraryFileUpload::make('thumbnail')
                        ->imageEditor()
                        ->collection('thumbnail')
                        ->visibility('public'),

                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->nullable()
                        ->multiple()
                        ->imageEditor()
                        ->enableReordering()
                        ->collection('gallery')
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
