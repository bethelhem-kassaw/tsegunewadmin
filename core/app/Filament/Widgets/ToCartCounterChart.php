<?php

namespace App\Filament\Widgets;

use App\Helper\DashboardDataFecher;
use App\Models\User;
use Filament\Widgets\Widget;
use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;

class ToCartCounterChart extends BarChartWidget

{
    protected static ?string $heading = 'Add to cart clicks';
    protected function getData(): array
    {
        $dashboardDataFecher = new DashboardDataFecher();
        $toCartTrend = $dashboardDataFecher->totalAddToCartPerMonthTrend();
        
        return [
            'datasets' => [
                [
                    'label' => 'Add to cart in this month',
                    'data' => $toCartTrend['daily_data'],
                ],
            ],
            'labels' => $toCartTrend['label'],
            // 'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
