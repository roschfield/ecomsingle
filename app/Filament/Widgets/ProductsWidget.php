<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\OrderItem;

class ProductsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalSold = OrderItem::sum('quantity');

        return [
            Stat::make('Products Sold', $totalSold),
        ];
    }
    protected int|string|array $columnSpan = 1;
}
