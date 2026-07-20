<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalesHistoryResource\Pages;
use App\Models\Order;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;

class SalesHistoryResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Sales';

    protected static ?string $navigationLabel = 'Sales History';

    protected static ?string $modelLabel = 'Sale';

    protected static ?string $pluralModelLabel = 'Sales';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'sales-history';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Order #')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date & Time')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),

                Tables\Columns\TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('NGN')
                    ->sortable()
                    ->weight('bold')
                    ->alignEnd(),

                Tables\Columns\TextColumn::make('payment_gateway')
                    ->label('Channel')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pos' => 'In-Store (POS)',
                        'paystack' => 'Paystack',
                        'flutterwave' => 'Flutterwave',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pos' => 'info',
                        'paystack' => 'success',
                        'flutterwave' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'delivered' => 'success',
                        'processing' => 'info',
                        'shipped' => 'warning',
                        'pending' => 'gray',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'success' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Quick date presets
                SelectFilter::make('date_preset')
                    ->label('Quick Filter')
                    ->options([
                        'today' => 'Today',
                        'yesterday' => 'Yesterday',
                        'this_week' => 'This Week',
                        'last_week' => 'Last Week',
                        'this_month' => 'This Month',
                        'last_month' => 'Last Month',
                        'last_30_days' => 'Last 30 Days',
                        'last_90_days' => 'Last 90 Days',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? null) {
                            'today' => $query->whereDate('created_at', today()),
                            'yesterday' => $query->whereDate('created_at', today()->subDay()),
                            'this_week' => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]),
                            'last_week' => $query->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]),
                            'this_month' => $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year),
                            'last_month' => $query->whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year),
                            'last_30_days' => $query->where('created_at', '>=', now()->subDays(30)),
                            'last_90_days' => $query->where('created_at', '>=', now()->subDays(90)),
                            default => $query,
                        };
                    }),

                // Custom date range
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('from')
                            ->label('From Date'),
                        DatePicker::make('until')
                            ->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators['from'] = 'From ' . \Carbon\Carbon::parse($data['from'])->toFormattedDateString();
                        }
                        if ($data['until'] ?? null) {
                            $indicators['until'] = 'Until ' . \Carbon\Carbon::parse($data['until'])->toFormattedDateString();
                        }
                        return $indicators;
                    }),

                SelectFilter::make('payment_gateway')
                    ->label('Channel')
                    ->options([
                        'pos' => 'In-Store (POS)',
                        'paystack' => 'Paystack',
                        'flutterwave' => 'Flutterwave',
                    ]),

                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),

                SelectFilter::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'success' => 'Success',
                        'pending' => 'Pending',
                        'failed' => 'Failed',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([])
            ->poll('30s');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Order Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('order_number')
                            ->label('Order Number')
                            ->weight('bold')
                            ->copyable(),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Date & Time')
                            ->dateTime('d M Y, h:i A'),
                        Infolists\Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'delivered' => 'success',
                                'processing' => 'info',
                                'shipped' => 'warning',
                                'pending' => 'gray',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),
                        Infolists\Components\TextEntry::make('payment_status')
                            ->label('Payment Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'success' => 'success',
                                'pending' => 'warning',
                                'failed' => 'danger',
                                default => 'gray',
                            }),
                        Infolists\Components\TextEntry::make('payment_gateway')
                            ->label('Payment Channel')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'pos' => 'In-Store (POS)',
                                'paystack' => 'Paystack',
                                default => ucfirst($state),
                            }),
                    ])
                    ->columns(3),

                Infolists\Components\Section::make('Customer Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('first_name')
                            ->label('First Name'),
                        Infolists\Components\TextEntry::make('last_name')
                            ->label('Last Name'),
                        Infolists\Components\TextEntry::make('email'),
                        Infolists\Components\TextEntry::make('phone'),
                    ])
                    ->columns(4)
                    ->collapsible(),

                Infolists\Components\Section::make('Items Purchased')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('items')
                            ->schema([
                                Infolists\Components\TextEntry::make('product.name')
                                    ->label('Product'),
                                Infolists\Components\TextEntry::make('quantity')
                                    ->label('Qty'),
                                Infolists\Components\TextEntry::make('price')
                                    ->label('Unit Price')
                                    ->money('NGN'),
                                Infolists\Components\TextEntry::make('total')
                                    ->label('Line Total')
                                    ->money('NGN')
                                    ->weight('bold'),
                            ])
                            ->columns(4),
                    ]),

                Infolists\Components\Section::make('Totals')
                    ->schema([
                        Infolists\Components\TextEntry::make('subtotal')
                            ->money('NGN'),
                        Infolists\Components\TextEntry::make('tax')
                            ->money('NGN'),
                        Infolists\Components\TextEntry::make('shipping')
                            ->money('NGN'),
                        Infolists\Components\TextEntry::make('total')
                            ->money('NGN')
                            ->weight('bold')
                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large),
                    ])
                    ->columns(4),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalesHistory::route('/'),
            'view' => Pages\ViewSale::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}
