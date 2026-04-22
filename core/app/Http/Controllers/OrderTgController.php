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
        $productUrl = $request->input('product_url', url('/products/' . $product->id));

        // 3. Send the Telegram Notification
        $this->notifyAdminViaTelegram($order, $product, $productUrl);

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }

private function notifyAdminViaTelegram($order, $product, $productUrl)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_ADMIN_CHAT_ID');

        // 1. Prepare the Customer Info (Using HTML)
        if ($order->telegram_id) {
            $customerInfo = "📱 <b>Source:</b> Telegram\n👤 <b>User:</b> @{$order->telegram_username}\n🆔 <b>ID:</b> {$order->telegram_id}";
        } else {
            // Clean the phone number of any spaces or dashes to ensure the tel: link works perfectly
            $cleanPhone = preg_replace('/[^0-9+]/', '', $order->phone_number);

$customerInfo = "🌐 <b>Source:</b> Website\n👤 <b>Name:</b> {$order->full_name}\n📞 <b>Phone:</b> {$cleanPhone}";        }

        // 2. Format Measurements
        $measurementsText = "";
        if (is_array($order->measurements)) {
            foreach ($order->measurements as $key => $value) {
                $measurementsText .= "   - <b>" . ucfirst($key) . "</b>: {$value}\n";
            }
        }

        // 3. Ensure the product URL has http:// or https:// so it is clickable
        if (!preg_match("~^(?:f|ht)tps?://~i", $productUrl)) {
            $productUrl = "https://" . $productUrl;
        }

        // Build the final caption using HTML tags
      $caption = "🚨 <b>NEW ORDER RECEIVED</b> 🚨\n\n"
            . "{$customerInfo}\n\n"
            . "📦 <b>Product:</b> " . ($product->name ?? 'N/A') . "\n"
            . "🔗 <b>Link:</b> <a href=\"{$productUrl}\">View Product on Website</a>\n"
            . "💰 <b>Price:</b> " . number_format($order->total_price, 2) . " ETB\n\n"
            . "📏 <b>Measurements:</b>\n"
            . $measurementsText;

        // --- IMAGE HANDLING ---
        $imageField = $product->image ?: $product->photos;

        if ($product && $imageField) {

            if (is_array($imageField)) {
                $firstImage = trim($imageField[0] ?? '');
            } else {
                $images = explode(',', $imageField);
                $firstImage = trim($images[0] ?? '');
            }

            if (empty($firstImage)) {
                $this->sendFallbackText($botToken, $chatId, $caption);
                return;
            }

            $isExternalUrl = filter_var($firstImage, FILTER_VALIDATE_URL);

            try {
                if ($isExternalUrl) {
                    $response = Http::post("https://api.telegram.org/bot{$botToken}/sendPhoto", [
                        'chat_id' => $chatId,
                        'photo'   => $firstImage,
                        'caption' => $caption,
                        'parse_mode' => 'HTML' // CHANGED TO HTML
                    ]);
                } else {
                    $cleanPath = ltrim(str_replace('storage/', '', $firstImage), '/');
                    $localPath = storage_path('app/public/' . $cleanPath);

                    if (file_exists($localPath)) {
                        $response = Http::attach(
                            'photo', file_get_contents($localPath), 'product.jpg'
                        )->post("https://api.telegram.org/bot{$botToken}/sendPhoto", [
                            'chat_id' => $chatId,
                            'caption' => $caption,
                            'parse_mode' => 'HTML' // CHANGED TO HTML
                        ]);
                    } else {
                        $this->sendFallbackText($botToken, $chatId, $caption);
                        return;
                    }
                }

                if (!$response->successful()) {
                    Log::error("Telegram API Error Response: " . $response->body());
                    $this->sendFallbackText($botToken, $chatId, $caption);
                }

            } catch (\Exception $e) {
                Log::error('EXCEPTION CAUGHT: ' . $e->getMessage());
                $this->sendFallbackText($botToken, $chatId, $caption);
            }
        } else {
            $this->sendFallbackText($botToken, $chatId, $caption);
        }
    }

    private function sendFallbackText($token, $chatId, $text)
    {
        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML' // CHANGED TO HTML
        ]);
    }
}
