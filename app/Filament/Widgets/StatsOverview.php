<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
    Stat::make('Total Users', User::count())
        ->description('Total Users')
        ->icon('heroicon-o-users')
        ->color('primary'),

    Stat::make('Total Products', Product::count())
        ->description('Total Products')
        ->icon('heroicon-o-shopping-cart')
        ->color('success'),

    Stat::make('Total Orders', Order::count())
        ->description('Total Orders')
        ->icon('heroicon-o-receipt-refund')
        ->color('danger'),

    Stat::make('Total Revenue', number_format(Order::sum('total_price'), 2) . ' $')
        ->description('Total Revenue')
        ->icon('heroicon-o-currency-dollar')
        ->color('warning'),
];
    }
}
