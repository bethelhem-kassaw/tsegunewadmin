<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Transaction;
use App\Helper\DhlService;
use App\Models\telegramOrder;
use App\Modules\Payment\PaypalApi;



class OrderTgController extends Controller
{
// Route::post('/api/orders/bespoke', [OrderController::class, 'store']);

public function store(Request $request)
{
    $order = telegramOrder::create([
        'telegram_id' => $request->telegram_id,
        'telegram_username' => $request->username,
        'product_id' => $request->product_id,
        'clothing_category' => $request->clothing_category,
        'measurements' => $request->customer_measurements, // JSON handled by Model Cast
        'total_price' => $request->price,
    ]);

    return response()->json(['success' => true, 'order_id' => $order->id]);
}
}