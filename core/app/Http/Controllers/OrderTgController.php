<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\telegramOrder;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderTgController extends Controller
{
    public function store(Request $request)
    {
        // 1. Save the Order to the Database
        $order = telegramOrder::create([
            'telegram_id'       => $request->telegram_id,
            'telegram_username' => $request->username,
            'full_name'         => $request->full_name,
            'phone_number'      => $request->phone_number,
            'product_id'        => $request->product_id,
            'clothing_category' => $request->clothing_category,
            'measurements'      => $request->customer_measurements, // Handled by Model Cast
            'total_price'       => $request->price,
        ]);

        // 2. Fetch the Product to get the name and image
        $product = Product::find($request->product_id);

        // 3. Send the Telegram Notification
        $this->notifyAdminViaTelegram($order, $product);

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }

    private function notifyAdminViaTelegram($order, $product)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_ADMIN_CHAT_ID');

        // 1. Prepare the Customer Info
        if ($order->telegram_id) {
            $customerInfo = "📱 **Source:** Telegram\n👤 **User:** @{$order->telegram_username}\n🆔 **ID:** {$order->telegram_id}";
        } else {
            $customerInfo = "🌐 **Source:** Website\n👤 **Name:** {$order->full_name}\n📞 **Phone:** {$order->phone_number}";
        }

        // 2. Format Measurements
        $measurementsText = "";
        if (is_array($order->measurements)) {
            foreach ($order->measurements as $key => $value) {
                $measurementsText .= "   - *" . ucfirst($key) . "*: {$value}\n";
            }
        }

        $caption = "🚨 **NEW ORDER RECEIVED** 🚨\n\n"
            . "{$customerInfo}\n\n"
            . "📦 **Product:** " . ($product->name ?? 'N/A') . "\n"
            . "💰 **Price:** " . number_format($order->total_price, 2) . " ETB\n\n"
            . "📏 **Measurements:**\n"
            . $measurementsText;

        // 3. Handle the Image URL
        // Ensure we have a full URL. If your 'image' field is just 'photo.jpg', 
        // we use asset() or secure_asset() to make it 'https://domain.com/storage/photo.jpg'
        $imageUrl = null;
        if ($product && $product->image) {
            // If it's already a full URL, use it. Otherwise, build it.
            $imageUrl = filter_var($product->image, FILTER_VALIDATE_URL)
                ? $product->image
                : asset('storage/' . $product->image);
        }

        try {
            if ($imageUrl) {
                $response = Http::post("https://api.telegram.org/bot{$botToken}/sendPhoto", [
                    'chat_id' => $chatId,
                    'photo'   => $imageUrl,
                    'caption' => $caption,
                    'parse_mode' => 'Markdown'
                ]);

                // If Telegram rejects the photo (e.g., 400 Bad Request), send as text instead
                if (!$response->successful()) {
                    Log::warning("Telegram Photo failed, sending text: " . $response->body());
                    $this->sendFallbackText($botToken, $chatId, $caption);
                }
            } else {
                $this->sendFallbackText($botToken, $chatId, $caption);
            }
        } catch (\Exception $e) {
            Log::error('Telegram Error: ' . $e->getMessage());
        }
    }

    private function sendFallbackText($token, $chatId, $text)
    {
        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'Markdown'
        ]);
    }
}
