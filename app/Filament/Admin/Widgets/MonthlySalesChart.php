<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class MonthlySalesChart extends ChartWidget
{
    protected static ?string $heading = 'Sales this month';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => Order::getCurrentMonthSales()['sales'],
                    'fill' => 'start',
                ],
            ],
            'labels' => Order::getCurrentMonthSales()['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
