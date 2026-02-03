<?php

namespace App\Helper;

use App\Models\Order;
use App\Models\Product;
use App\Models\ToCartCount;
use App\Models\Transaction;
use App\Models\UniqueVisitor;
use App\Models\User;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class DashboardDataFecher
{
    public function totalCustomerTrend()
    {
        $trend = Trend::model(User::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $data = $trend->map(fn (TrendValue $value) => $value->aggregate)->toArray();
        $label = $trend->map(fn (TrendValue $value) => $value->date)->toArray();
        $totalCustomer = User::all()->count();
        return ['total_customers' => $totalCustomer, 'monthly_data' => $data, 'label' => $label, 'new_customers' => array_sum($data)];
    }
    public function totalOrderTrend()
    {
        $trend = Trend::model(Order::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $data = $trend->map(fn (TrendValue $value) => $value->aggregate)->toArray();
        $label = $trend->map(fn (TrendValue $value) => $value->date)->toArray();
        $totalOrders = Order::all()->count();
        return ['total_orders' => $totalOrders, 'monthly_data' => $data, 'label' => $label, 'new_orders' => array_sum($data)];
    }

    public function totatProductTrend()
    {
        $productTrend = Trend::model(Product::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $data = $productTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray();
        $label = $productTrend->map(fn (TrendValue $value) => $value->date)->toArray();
        $totalProduct = Product::all()->count();
        return ['total_products' => $totalProduct, 'monthly_data' => $data, 'label' => $label, 'new_products' => array_sum($data)];
    }
    public function totalTransactionTrend()
    {
        $transactionTrend = Trend::model(Transaction::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $data = $transactionTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray();
        $label = $transactionTrend->map(fn (TrendValue $value) => $value->date)->toArray();
        $totalTxn = Transaction::all()->count();
        return ['total_txn' => $totalTxn, 'monthly_data' => $data, 'label' => $label, 'new_txns' => array_sum($data)];
    }
    public function totalAddToCartTrend()
    {
        $cartCountTrend = Trend::model(ToCartCount::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('count_per_day');
        $data = $cartCountTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray();
        $label = $cartCountTrend->map(fn (TrendValue $value) => $value->date)->toArray();
        $totalCount = ToCartCount::all()->count();
        return ['total' => $totalCount, 'monthly_data' => $data, 'label' => $label, 'new' => array_sum($data)];
    }
    public function totalAddToCartPerMonthTrend()
    {
        $cartCountTrend = Trend::model(ToCartCount::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->sum('count_per_day');
        $data = $cartCountTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray();
        $label = $cartCountTrend->map(fn (TrendValue $value) => $value->date)->toArray();
        $totalCount = ToCartCount::all()->count();
        return ['total' => $totalCount, 'daily_data' => $data, 'label' => $label, 'new' => array_sum($data)];
    }
    public function uniqueVisitorTrend()
    {
        $visitorTrent = Trend::model(UniqueVisitor::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $data = $visitorTrent->map(fn (TrendValue $value) => $value->aggregate)->toArray();
        $label = $visitorTrent->map(fn (TrendValue $value) => $value->date)->toArray();
        $totalCount = UniqueVisitor::all()->count();
        return ['total' => $totalCount, 'monthly_data' => $data, 'label' => $label, 'new' => array_sum($data)];
    }
}
