<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class SalesDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Sales Distribution (by Category)';

    protected static ?int $sort = 2;

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

        $query = OrderItem::query()
            ->whereHas('order', function ($q) {
                $q->where('payment_status', 'success');
            })
            ->with('product');

        if ($activeFilter === 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($activeFilter === 'week') {
            $query->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()]);
        } elseif ($activeFilter === 'month') {
            $query->whereBetween('created_at', [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()]);
        } elseif ($activeFilter === 'year') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        $items = $query->get();

        $categoryTotals = [];

        foreach ($items as $item) {
            $categoryName = $item->product ? $item->product->category : 'Uncategorized';
            if (!isset($categoryTotals[$categoryName])) {
                $categoryTotals[$categoryName] = 0;
            }
            $categoryTotals[$categoryName] += $item->total;
        }

        $labels = array_keys($categoryTotals);
        $data = array_values($categoryTotals);

        // Standard palette for pie charts, using shades of gray/black for the theme
        $backgroundColors = [
            '#000000', '#18181b', '#27272a', '#3f3f46', '#52525b', 
            '#71717a', '#a1a1aa', '#d4d4d8', '#e4e4e7', '#f4f4f5'
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Sales by Category',
                    'data' => $data,
                    'backgroundColor' => array_slice($backgroundColors, 0, count($data)),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
