<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;


class YearlyOrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Orders this year';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Orders this year',
                    'data' => Order::getCurrentYearOrders()['orders'],
                    'fill' => 'start',
                ],
            ],
            'labels' => Order::getCurrentYearOrders()['labels'],
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }
}
