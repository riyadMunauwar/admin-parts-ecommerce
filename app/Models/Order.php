<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use App\Models\Address;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;



    protected $casts = [
        'order_date' => 'datetime',
        'paid_at' => 'datetime',
    ];



    public function totalPrice()
    {
        return $this->total_product_price + $this->shipping_cost + $this->total_vat;
    }


    public static function getCurrentYearSales()
    {
        $currentYear = Carbon::now()->year;
    
        $sales = static::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_product_price) as total_sales')
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->get();
    
        $chartLabels = [];
        $chartSales = [];
    
        foreach ($sales as $sale) {
            // Create a label for the month (e.g., "Jan 2023")
            $monthLabel = Carbon::createFromDate($sale->year, $sale->month)->format('M Y');
            $chartLabels[] = $monthLabel;
    
            $chartSales[] = $sale->total_sales;
        }
    
        return ['labels' => $chartLabels, 'sales' => $chartSales];
    }


    public static function getCurrentMonthSales()
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $sales = static::selectRaw('DATE(created_at) as date, SUM(total_product_price) as total_sales')
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->groupBy('created_at')
            ->get();

        $chartDates = [];
        $chartSales = [];

        foreach ($sales as $sale) {
            $chartDates[] = Carbon::parse($sale->date)->format('m d');
            $chartSales[] = $sale->total_sales;
        }

        return ['labels' => $chartDates, 'sales' => $chartSales];
    }


    public static function getCurrentMonthOrders()
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $orders = static::selectRaw('DATE(created_at) as date, COUNT(*) as total_orders')
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->groupBy('created_at')
            ->get();

        $chartDates = [];
        $chartOrders = [];

        foreach ($orders as $order) {
            $chartDates[] = Carbon::parse($sale->date)->format('m d');
            $chartOrders[] = $order->total_orders;
        }

        return ['labels' => $chartDates, 'orders' => $chartOrders];
    }


    public static function getCurrentYearOrders()
    {
        $currentYear = Carbon::now()->year;
    
        $sales = static::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total_orders')
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->get();
    
        $chartLabels = [];
        $chartOrders = [];
    
        foreach ($sales as $sale) {
            // Create a label for the month (e.g., "Jan 2023")
            $monthLabel = Carbon::createFromDate($sale->year, $sale->month)->format('M Y');
            $chartLabels[] = $monthLabel;
    
            $chartSales[] = $sale->total_orders;
        }
    
        return ['labels' => $chartLabels, 'orders' => $chartOrders];
    }


    // Dynamic Property

    public function getTotalPriceAttribute()
    {
        return $this->total_product_price + $this->shipping_cost + $this->total_vat;
    }

    // Relation

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function admin()
    {
       return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

}
