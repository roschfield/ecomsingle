<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget\Stat;
class RevenueWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Order::where('status', '!=', 'canceled')->sum('grand_total');

        return [
            Stat::make('Total Revenue', '$' . number_format($totalRevenue, 2)),
        ];
    }
    protected int|string|array $columnSpan = 1;
}
