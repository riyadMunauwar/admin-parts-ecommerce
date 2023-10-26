<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class MonthlyOrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Sales this year',
                    'data' => Order::getCurrentYearSales()['sales'],
                    'fill' => 'start',
                ],
            ],
            'labels' => Order::getCurrentYearSales()['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
