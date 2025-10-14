<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TopCategoriesChart extends ChartWidget
{
    protected ?string $heading = 'Top Performing Categories'; // <-- non-static

    protected function getData(): array
    {
        $data = OrderItem::selectRaw('categories.name as category, SUM(order_items.quantity) as total_sold')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Units Sold',
                    'data' => $data->pluck('total_sold')->values(),
                    'backgroundColor' => [
                        '#3b82f6',
                        '#22c55e',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                    ],
                ],
            ],
            'labels' => $data->pluck('category')->values(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
    protected int|string|array $columnSpan = 1;
}
