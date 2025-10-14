<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OrdersOverTimeChart extends ChartWidget
{
    protected ?string $heading = 'Orders Completed Over Time'; // <-- non-static

    protected function getData(): array
    {
        $data = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('status', 'delivered') // check your exact status spelling
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Completed Orders',
                    'data' => $data->pluck('total')->values(),
                    'backgroundColor' => array_fill(0, $data->count(), '#22c55e'),
                    'borderColor' => array_fill(0, $data->count(), '#16a34a'),
                ],
            ],
            'labels' => $data->pluck('date')->values(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    protected int|string|array $columnSpan = 1;
}
