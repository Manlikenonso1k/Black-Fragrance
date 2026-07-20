<?php

namespace App\Filament\Resources\SalesHistoryResource\Pages;

use App\Filament\Resources\SalesHistoryResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSalesHistory extends ListRecords
{
    protected static string $resource = SalesHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Sales')
                ->icon('heroicon-o-squares-2x2'),

            'today' => Tab::make('Today')
                ->icon('heroicon-o-sun')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('created_at', today())),

            'this_week' => Tab::make('This Week')
                ->icon('heroicon-o-calendar-days')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])),

            'this_month' => Tab::make('This Month')
                ->icon('heroicon-o-calendar')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)),

            'pos' => Tab::make('POS Sales')
                ->icon('heroicon-o-calculator')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_gateway', 'pos')),

            'online' => Tab::make('Online Sales')
                ->icon('heroicon-o-globe-alt')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_gateway', '!=', 'pos')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SalesHistoryResource\Widgets\SalesSummaryWidget::class,
        ];
    }
}
