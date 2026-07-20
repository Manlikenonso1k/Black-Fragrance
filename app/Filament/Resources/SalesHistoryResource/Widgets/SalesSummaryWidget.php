<?php

namespace App\Filament\Resources\SalesHistoryResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SalesSummaryWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $todaySales = Order::whereDate('created_at', today())->sum('total');
        $todayCount = Order::whereDate('created_at', today())->count();

        $weekSales = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total');
        $weekCount = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        $monthSales = Order::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total');
        $monthCount = Order::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        return [
            Stat::make('Today\'s Sales', '₦' . number_format($todaySales))
                ->description($todayCount . ' order(s) today')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('success'),

            Stat::make('This Week', '₦' . number_format($weekSales))
                ->description($weekCount . ' order(s) this week')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('info'),

            Stat::make('This Month', '₦' . number_format($monthSales))
                ->description($monthCount . ' order(s) this month')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('warning'),
        ];
    }
}
