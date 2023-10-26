<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class DashboardStatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [

            Stat::make('Total Sales', '$' . $this->getTotalSales()),
            // ->description('32k increase')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->chart([7, 2, 10, 3, 15, 4, 17])
            // ->color('success'),

            Stat::make('Total Orders', $this->getTotalOrdersCount()),

            Stat::make('Total Products', $this->getTotalProductsCount()),

            Stat::make('Total Customers', $this->getTotalCustomersCount()),

            Stat::make('Today Sales', '$' . $this->getTodayTotalSales()),


            Stat::make('Today Orders', '$' . $this->getTodayTotalOrdersCount()),


        ];
    }


    private function getTotalSales()
    {
        return Order::where('payment_status', 'paid')->sum('total_product_price');
    }

    private function getTotalOrdersCount()
    {
        return Order::count();
    }

    private function getTotalProductsCount()
    {
        return Product::count();
    }

    private function getTotalCustomersCount()
    {
        return User::count();
    }

    private function getTodayTotalSales()
    {
        return Order::whereDate('created_at', now()->today())->where('payment_status', 'paid')->sum('total_product_price');
    }

    private function getTodayTotalOrdersCount()
    {
        return Order::whereDate('created_at', now()->today())->count();
    }

}
