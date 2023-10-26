<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [

            Stat::make('Total Sales', '$192.1k'),
            // ->description('32k increase')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->chart([7, 2, 10, 3, 15, 4, 17])
            // ->color('success'),

            Stat::make('Total Orders', '1340'),

            Stat::make('Total Products', '3543'),

            Stat::make('Total Customers', '3543'),

            Stat::make('Today Sales', '3543'),


            Stat::make('Today Orders', '3543'),


        ];
    }
}
