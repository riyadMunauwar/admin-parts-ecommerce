<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class MonthlyOrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Orders this month';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Orders this month',
                    'data' => Order::getCurrentMonthOrders()['orders'],
                    'fill' => 'start',
                ],
            ],
            'labels' => Order::getCurrentMonthOrders()['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
