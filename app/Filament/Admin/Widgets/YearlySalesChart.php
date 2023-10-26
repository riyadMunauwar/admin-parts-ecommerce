<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;

class YearlySalesChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
