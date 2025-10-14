<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\RevenueWidget;
use App\Filament\Widgets\ProductsWidget;
use App\Filament\Widgets\TopCategoriesChart;
use App\Filament\Widgets\OrdersOverTimeChart;

class Dashboard extends BaseDashboard
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    public function getWidgets(): array
    {
        return [
            RevenueWidget::class,
            ProductsWidget::class,
            TopCategoriesChart::class,
           // OrdersOverTimeChart::class,
        ];
    }

    public function getColumns(): array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 2,
            'xl' => 2,
        ];
    }
}
