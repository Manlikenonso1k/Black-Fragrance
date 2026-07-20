<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class SalesTrendChart extends ChartWidget
{
    protected static ?string $heading = 'Sales Trend';

    protected static ?int $sort = 1;

    public ?string $filter = 'week';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last 7 Days',
            'month' => 'Last 30 Days',
            'year' => 'This Year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $query = Order::query()->where('payment_status', 'success');

        $labels = [];
        $data = [];

        if ($activeFilter === 'today') {
            $orders = $query->whereDate('created_at', Carbon::today())->get();
            // Group by hour
            $grouped = $orders->groupBy(fn($order) => Carbon::parse($order->created_at)->format('H:00'));
            
            for ($i = 0; $i < 24; $i++) {
                $hour = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                $labels[] = $hour;
                $data[] = isset($grouped[$hour]) ? $grouped[$hour]->sum('total') : 0;
            }
        } elseif ($activeFilter === 'week') {
            $orders = $query->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])->get();
            $grouped = $orders->groupBy(fn($order) => Carbon::parse($order->created_at)->format('M d'));
            
            for ($i = 6; $i >= 0; $i--) {
                $day = Carbon::now()->subDays($i)->format('M d');
                $labels[] = $day;
                $data[] = isset($grouped[$day]) ? $grouped[$day]->sum('total') : 0;
            }
        } elseif ($activeFilter === 'month') {
            $orders = $query->whereBetween('created_at', [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()])->get();
            $grouped = $orders->groupBy(fn($order) => Carbon::parse($order->created_at)->format('M d'));
            
            for ($i = 29; $i >= 0; $i--) {
                $day = Carbon::now()->subDays($i)->format('M d');
                $labels[] = $day;
                $data[] = isset($grouped[$day]) ? $grouped[$day]->sum('total') : 0;
            }
        } elseif ($activeFilter === 'year') {
            $orders = $query->whereYear('created_at', Carbon::now()->year)->get();
            $grouped = $orders->groupBy(fn($order) => Carbon::parse($order->created_at)->format('M'));
            
            for ($i = 1; $i <= 12; $i++) {
                $month = Carbon::create()->month($i)->format('M');
                $labels[] = $month;
                $data[] = isset($grouped[$month]) ? $grouped[$month]->sum('total') : 0;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Sales (₦)',
                    'data' => $data,
                    'fill' => 'start',
                    'borderColor' => '#000000', // Matches Light Mode Primary
                    'backgroundColor' => 'rgba(0,0,0,0.1)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
