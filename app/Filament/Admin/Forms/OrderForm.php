<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Product;
use App\Models\User;
use Filament\Forms\Get;

class OrderForm
{
    public static function make() : array
    {
        return [
            Forms\Components\Tabs::make('Label')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Order Details')
                        ->schema([

                            Forms\Components\Section::make('Order Info')
                                ->schema([

                                    Forms\Components\Select::make('status')
                                        ->label('Order Status')
                                        ->options([
                                            'new' => 'New',
                                            'pending' => 'Pending',
                                            'shipped' => 'Shipped',
                                            'delivered' => 'Delivered',
                                            'cancelled' => 'Cancelled',
                                            'refunded' => 'Refunded',
                                        ])
                                        ->native(false)
                                        ->required(),

                                    Forms\Components\Select::make('payment_status')
                                        ->label('Payment status')
                                        ->options([
                                            'paid' => 'Paid',
                                            'unpaid' => 'Unpaid',
                                        ])
                                        ->native(false)
                                        ->required(),

                                    Forms\Components\Select::make('user_id')
                                        ->label('Customer')
                                        ->getSearchResultsUsing(fn (string $search): array => User::where('name', 'like', "%{$search}%")->limit(12)->pluck('name', 'id')->toArray())
                                        ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name)
                                        ->searchable()
                                        ->preload()
                                        ->native(false)
                                        ->required(),

                                    Forms\Components\TextInput::make('total_product_price')
                                        ->numeric()
                                        ->required(),

                                    Forms\Components\TextInput::make('shipping_cost')
                                        ->label('Shipping price')
                                        ->numeric()
                                        ->nullable(),

                                    Forms\Components\TextInput::make('total_vat')
                                        ->label('Total vat')
                                        ->numeric()
                                        ->nullable(),

                                    Forms\Components\TextInput::make('used_credit')
                                        ->numeric()
                                        ->nullable(),

                                    Forms\Components\TextInput::make('payment_method_name')
                                        ->nullable(),

                                    Forms\Components\DateTimePicker::make('estimate_delivery_date')
                                        ->native(false)
                                        ->nullable(),

                                    Forms\Components\TextInput::make('estimate_delivery_time')
                                        ->nullable(),

                                    Forms\Components\TextInput::make('tracking_url')
                                        ->nullable()
                                        ->columnSpanFull(),

                                    Forms\Components\TextInput::make('tracking_number')
                                        ->nullable()
                                        ->columnSpanFull(),

                                    Forms\Components\Textarea::make('admin_note')
                                        ->nullable()
                                        ->columnSpanFull(),

                                    Forms\Components\Textarea::make('order_note')
                                        ->label('Customer note')
                                        ->nullable()
                                        ->columnSpanFull(),



                                ])->columns(2),
                        ]),
                    Forms\Components\Tabs\Tab::make('Order Items')
                        ->schema([
                            Forms\Components\Repeater::make('orderItems')
                                ->relationship()
                                ->schema([
                                    Forms\Components\Select::make('product_id')
                                        ->label('Product')
                                        ->getSearchResultsUsing(fn (string $search): array => Product::where('search_name', 'like', "%{$search}%")->limit(12)->pluck('search_name', 'id')->toArray())
                                        ->getOptionLabelUsing(fn ($value): ?string => Product::find($value)?->search_name)
                                        ->searchable()
                                        ->preload()
                                        ->native(false)
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                            // if ($operation !== 'create') {
                                            //     return;
                                            //

                                            $price = Product::find($state)->sale_price;


                                            $set('price', $price);
                                        })
                                        ->columnSpan(2),

                                        Forms\Components\TextInput::make('price')
                                            ->live()
                                            ->numeric()
                                            ->required(),

                                        Forms\Components\TextInput::make('qty')
                                            ->live()
                                            ->numeric()
                                            ->required(),

                                        Forms\Components\Placeholder::make('line_total')
                                            ->content(function(Get $get){
                                                return $get('price') * $get('qty');
                                            }),


                                ])
                                ->columns(5)
                        ]),
                    Forms\Components\Tabs\Tab::make('Customer')
                        ->schema([
                            // ...
                        ]),
            ]),
        ];
    }
}
