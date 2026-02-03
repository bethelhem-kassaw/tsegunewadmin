<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Components\Tab as ComponentsTab;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // tabs
    public function getTabs(): array
    {
        return [
            'all' => ComponentsTab::make()->modifyQueryUsing(function ($query) {
                return $query;
            }),
            'pending' => ComponentsTab::make()->modifyQueryUsing(function ($query) {

                $query->where('status', 'pending');
                return $query;
            })    ->badge(fn () => \App\Models\Order::where('status', 'pending')->count())
            ,
            'approved' => ComponentsTab::make()->modifyQueryUsing(function ($query) {
                $query->where('status', 'approved');
                return $query;
            }),
            'cancelled' => ComponentsTab::make() ->modifyQueryUsing(function ($query) {
                $query->where('status', 'cancelled');
                return $query;
            }),
            'refunded' => ComponentsTab::make() ->modifyQueryUsing(function ($query) {
                $query->where('status', 'refunded');
                return $query;
            }),
            'completed' => ComponentsTab::make()            ->modifyQueryUsing(function ($query) {
                $query->where('status', 'completed');
                return $query;
            }),
            'this sunday orders' => ComponentsTab::make()            ->modifyQueryUsing(function ($query) {
   //delivery date from details
   $thisSunday = now()->startOfWeek()->addDays(6);

   $query->whereHas('orderDetails', function ($query) use ($thisSunday) {
    $query->whereDate('delivery_date', $thisSunday);
});

                return $query;
            })   ->badge(fn () => \App\Models\Order::whereHas('orderDetails', function ($query) {
                $query->whereDate('delivery_date', now()->startOfWeek()->addDays(6)); // This Sunday's date
            })->count())
            ,

        ];
    }
}
