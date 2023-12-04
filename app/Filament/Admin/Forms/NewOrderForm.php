<?php

namespace App\Filament\Admin\Forms;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Product;
use App\Models\User;


class NewOrderForm
{

    public static function make()
    {
        return [

            Forms\Components\Group::make()
                ->schema([

                    Forms\Components\Grid::make()
                        ->schema([

                            // Left Side
                            Forms\Components\Grid::make()
                                ->schema([

                                    Forms\Components\Section::make('Order Details')
                                        ->schema([

                                            Forms\Components\TextInput::make('total_product_price')
                                                ->required()
                                                // ->disabled(),
                                                ->prefix('$'),

                                            Forms\Components\TextInput::make('shipping_cost')
                                                ->prefix('$')
                                                ->numeric()
                                                ->required(),

                                            Forms\Components\Select::make('user_id')
                                                ->relationship('customer', 'email')
                                                ->searchable()
                                                ->required()
                                                ->createOptionForm(\App\Filament\Admin\Forms\UserForm::make())
                                                ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                                                    return $action
                                                        ->modalHeading('Create customer')
                                                        ->modalButton('Create customer')
                                                        ->modalWidth('lg');
                                                })
                                                ->live()
                                                ->columnSpanFull(),


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


                                            Forms\Components\Textarea::make('order_note')
                                                ->label('Customer note')
                                                ->columnSpan('full'),

                                            Forms\Components\Textarea::make('admin_note')
                                                ->label('Admin note')
                                                ->columnSpan('full'),


                                        ])
                                        ->collapsible()
                                        ->columnSpanFull()
                                        ->columns(2),


                                    Forms\Components\Section::make('Shipping address')
                                        ->relationship('address')
                                        ->default(1)
                                        ->schema(\App\Filament\Admin\Forms\AddressForm::make())
                                        ->columnSpanFull()
                                        ->collapsible()
                                        ->columns(2),

                                ])
                                ->columnSpan(2),

                            // Right Grid
                            Forms\Components\Grid::make()
                                ->schema([

                                    Forms\Components\Section::make('Status')
                                        ->schema([

                                            Forms\Components\TextInput::make('id')
                                                ->label('Order No#')
                                                ->prefix('OR#-')
                                                ->disabled()
                                                ->dehydrated()
                                                ->hidden(fn(string $operation) => $operation === 'create'),


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

                                            Forms\Components\Select::make('admin_id')
                                                ->relationship('admin', 'name')
                                                ->label('Order proccess by')
                                                ->getSearchResultsUsing(fn (string $search): array => User::where('name', 'like', "%{$search}%")->limit(12)->pluck('name', 'id')->toArray())
                                                ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name)
                                                ->default(auth()->id())
                                                ->searchable()
                                                ->nullable(),


                                        ])
                                        ->collapsible()
                                        ->columns(1)
                                        ->columnSpanFull(),

                                        \App\Filament\Admin\Forms\TimestampsForm::make(),

                                ])
                                ->columnSpan(1),
                        ])
                        ->columns(3),




                    Forms\Components\Section::make('Order items')
                        ->schema([

                            Forms\Components\Repeater::make('orderItems')
                                ->relationship()
                                ->schema([

                                    Forms\Components\Select::make('product_id')
                                        ->label('Product')
                                        ->getSearchResultsUsing(fn (string $search): array => Product::where('name', 'like', "%{$search}%")->limit(12)->pluck('name', 'id')->toArray())
                                        ->getOptionLabelUsing(fn ($value): ?string => Product::find($value)?->name)
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('unit_price', Product::find($state)?->price ?? 0))
                                        ->columnSpan([
                                            'md' => 2,
                                        ])
                                        ->searchable(),

                                    Forms\Components\TextInput::make('qty')
                                        ->label('Quantity')
                                        ->numeric()
                                        ->live()
                                        ->default(1)
                                        ->columnSpan(1)
                                        ->required(),

                                    Forms\Components\TextInput::make('price')
                                        ->label('Unit Price')
                                        ->prefix('$')
                                        ->required()
                                        ->live()
                                        ->numeric()
                                        ->required()
                                        ->columnSpan(1),

                                    Forms\Components\TextInput::make('line_total')
                                        ->label('Line Total')
                                        ->prefix('$')
                                        ->disabled()
                                        ->placeholder(function(GET $get){
                                            return $get('price') * $get('qty');
                                        })
                                        ->columnSpan(1),

                                ])
                                // ->orderable()
                                ->defaultItems(1)
                                ->disableLabel()
                                ->columns([
                                    'md' => 5,
                                ])
                                ->live()
                                ->afterStateUpdated(function ($state, Forms\Set $set, string $operation) {
                                   $sum = 0;

                                   foreach($state as $item){
                                       $sum += (float) $item['qty'] * (float) $item['price'];
                                   }

                                   return $set('total_product_price', $sum);
                                }),
                        ])
                        ->collapsible(),
                ])

                ->columnSpanFull(),

        ];
    }
}
