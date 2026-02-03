<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\orderrequest;
use App\Models\Adress;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\paypalpayment;
use App\Models\TempOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
// Import the class namespaces first, before using it directly
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class paypalcontroller extends Controller
{
/*
email testing
sb-6321s34729877@personal.example.com
Card number : 4032036382400180
Expiry date : 10/2029
CVC code : 673
*/


public function pypaltest (Request $request,orderrequest $orderrequest){

    $provider = new PayPalClient;


    $provider->setApiCredentials(config('paypal'));
    $provider->getAccessToken();


    // Process Images
    $products = $orderrequest['products'];
    $processedProducts = [];
// return response()->json([$orderrequest->all()]);
foreach ($products  as $product) {
    $imagePaths = [];
    // return response()->json([$product]);
    if (!empty($product['photopath'])) {
        foreach ($product['photopath'] as $photo) {
            // Save the image in the storage and get the path
            $imagePaths[] = $photo->store('photopath', 'public');
        }
    }
    // Add the image paths to the product


    $product['photopath'] = $imagePaths;
    $processedProducts[] = $product;

    // dd($product);
}



//   dd($provider->getAccessToken();)

 // Store address and other details in session or process them directly
 $checkoutData = [
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'product' =>$processedProducts,

    // $orderrequest->input('products'),
    'delivery_date' => $request->delivery_date,
    'quantity' => $request->quantity,
    'price' => $request->price,
    'specifications'=>$request->input('specifications'),
    'address' => $request->input('address'),
    'total_price'=>$request->total_price,
    // 'photopath'=>$orderrequest->input('photopath'),
    'text_details'=>$request->text_details,
];


// dd($checkoutData);
// Generate a unique identifier
$transactionId = Str::uuid();
\Cache::put("checkout_data_{$transactionId}", $checkoutData, now()->addMinutes(60));
// $orderDetails = \Cache::get("checkout_data_{$transactionId}");
// return response()->json(['response from me'=>[$orderDetails]]);
// TempOrder::create([
//     'transaction_id' => $transactionId,
//     'data' => json_encode($checkoutData),
// ]);


    $response = $provider->createOrder([

"intent"=> "CAPTURE",
"application_context"=>[
    "return_url"=> route('success'). "?transaction_id={$transactionId}",
    "cancel_url"=> route('cancel')
],
    "purchase_units"=> [
      [
        "amount"=> [
          "currency_code"=> "USD",
          "value"=> number_format($request->total_price, 2, '.', ''),
        ]
      ]
    ]

    ]);
    // dd(isset($response['id']) && $response['id'] != null);

 session()->put('checkout_data', $checkoutData);



    if(isset($response['id']) && $response['id'] != null){




        foreach($response['links'] as $link){
            // dd($link['rel']=='approve');
            if($link['rel']=='approve'){
                // session()->put('product_name',$request->product_name);
                session()->put('quantity',$request->quantity);

                // $data = session()->get('quantity');

                // return response()->json([$data]);
                // return redirect()->away($link['href']);
                return response()->json([
                'success' => true,
                'approval_url' => $link['href'],
            ]);

            }

        }
    }else{

        return redirect()->route('cancel');
    }

}

public function success(Request $request){

    $token = $request->bearerToken();
    // $userId = auth()->id(); // Get authenticated user ID, if available
    $accessToken = PersonalAccessToken::findToken($token);

    if ($token) {
        $accessToken = PersonalAccessToken::findToken($token);

        if ($accessToken && $accessToken->tokenable) {
            $userId = $accessToken->tokenable->id;
        } else {
            $userId = session()->getId();
        }
    } else {
        $userId = session()->getId();
    }
    $transactionId = $request->query('transaction_id');

    $orderDetails = \Cache::get("checkout_data_{$transactionId}");
    // \Cache::forget("checkout_data_{$transactionId}");


    // dd($orderDetails);

    // $tempOrder = TempOrder::where('transaction_id', $transactionId)->first();


// dd($checkoutData);

    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $provider->getAccessToken();
    $response = $provider->capturePaymentOrder($request->token);

    if(isset($response['status']) && $response['status'] == 'COMPLETED') {

        // Save payment details to the database
        // $orderDetails = session()->get('checkout_data');



        // $address = Adress::create([

        // ]);

        $address = Adress::create([
            'fullname' => $orderDetails['address']['fullname'],
            'phone' => $orderDetails['address']['phone'],
            'email' => $orderDetails['address']['email'],
            'postal_code' =>$orderDetails['address']['postal_code'],
            'posta_number' => $orderDetails['address']['posta_number'],
            'addressLine1' => $orderDetails['address']['addressLine1'],
            'addressLine2' => $orderDetails['address']['addressLine2'],
            'addressLine3' => $orderDetails['address']['addressLine3'],
            'country_id' => $orderDetails['address']['country_id'],
            'city_id' => $orderDetails['address']['city_id'],
            'sub_city_id' => $orderDetails['address']['sub_city_id'],
        ]);

        // return response()->json([$address->id]);


       $payment = PaypalPayment::create([
                'payment_id' => $response['id'],
                'amount' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
                'currency' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
                'payer_name' => $response['payer']['name']['given_name'] ?? 'Unknown',
                'payer_email' => $response['payer']['email_address'] ?? 'Unknown',
                'payment_status' => $response['status'],
                'payment_method' => 'PayPal',
            ]);


            // Create the order
            $order = Order::create([

                'user_id' => $userId,
                'shppment_adress_id' => $address->id,
                'payment_id' => $payment->id,
                'status' => 'pending',
                'name' => $orderDetails['name'] ?? $response['payer']['name']['given_name'],
                'email' => $response['payer']['email_address'] ?? null,
                'phone' => $orderDetails['phone'] ?? null,
                'orderId' => strtoupper(uniqid()),
            ]);







        foreach ($orderDetails['product'] as $product) {


            if (!empty($product['options'])) {
                $attributes = $product['options'];
                }
            // $attributesData = [];
            // return response()->json([$attributes]);
            // foreach ($attributes as $attribute) {
            //     // You can use the attribute name and value pair for the order details
            //     // You can filter or modify this logic as needed
            //     $attributesData[] = [
            //         'attribute_id' => $attribute->attribute_id,
            //         'attribute_value' => $attribute->values
            //     ];
            // }

        // if (!empty($product['photopath'])) {
        //     foreach ($product['photopath'] as $photo) {

        //         $path = $photo; // Save photo to storage
        //         $photoPaths[]= $path;// Add path to array
        //     }

        // }
        // return response()->json($orderDetails['product'][]);

        $product_id = (int)$product['product_id'];
        $quantity = (int)$product['quantity'];


        OrderDetail::create([
              'order_id' => $order->id,
              'product_id' =>$product_id,
              'quantity' => $quantity,
              'text_details' => $product['text_details'] ?? null,
              'path' => $product['photopath'] ?? null,
              'specifications' => $attributes ?? null,
                'delivery_date' => $orderDetails['delivery_date'], // Save delivery date
          ]);
        }


          // Mark cart items as purchased
    Cart::where('user_id',  $userId)->update(['status' => 'purchased', 'order_id' => $order->id]);








            // Clear session data
        session()->forget('checkout_data');

        return redirect()->away('https://joygiftset.com/order-confirmation?order_id=' . $order->orderId);


        } else {
        return redirect() ->route ('cancel');}


}

public function cancel(){
    return  redirect()->away('https://joygiftset.com/cart');

}





public function cardPayment(orderrequest $request)
{


    // return response()->json([$request->all()]);
    $token = $request->bearerToken();
    // $userId = auth()->id(); // Get authenticated user ID, if available
    $accessToken = PersonalAccessToken::findToken($token);

    if ($token) {
        $accessToken = PersonalAccessToken::findToken($token);

        if ($accessToken && $accessToken->tokenable) {
            $userId = $accessToken->tokenable->id;
        } else {
            $userId = session()->getId();
        }
    } else {
        $userId = session()->getId();
    }

//     $path = $request->products[0]['photoPaths'][0]->store('photopath', 'public'); // Save photo to storage
//     // $photoPaths[] = $path;
// dd(Storage::url($path));
    //
//     foreach ($request['products'] as $product) {

//         if (!empty($product['photopath'])) {
//             foreach ($product['photopath'] as $photo) {
//                 $path = $photo->store('photopath', 'public'); // Save photo to storage
//                 $photoPaths[] = Storage::url($path);// Add path to array
//             }
//         }
// return response()->json([$photoPaths]);
//     }
   // Determine PayPal mode and set credentials and endpoint accordingly
if (env('PAYPAL_MODE') == 'live') {
    $clientId = env('PAYPAL_LIVE_CLIENT_ID');
    $clientSecret = env('PAYPAL_LIVE_CLIENT_SECRET');
    $endpoint = 'https://api-m.paypal.com/v1/oauth2/token';
    // $orderEndpoint = 'https://api-m.paypal.com/v2/checkout/orders';
    $endpointtest ='https://api-m.paypal.com/v2/checkout/orders';
} else {
    $clientId = env('PAYPAL_SANDBOX_CLIENT_ID');
    $clientSecret = env('PAYPAL_SANDBOX_CLIENT_SECRET');
    $endpoint = 'https://api-m.sandbox.paypal.com/v1/oauth2/token';
    $endpointtest ='https://api-m.sandbox.paypal.com/v2/checkout/orders';
    $orderEndpoi = 'https://api-m.sandbox.paypal.com/v2/checkout/orders';
}


// Step 1: Get Access Token
$response = Http::asForm()->withBasicAuth($clientId, $clientSecret)
    ->post($endpoint, [
        'grant_type' => 'client_credentials',
    ]);

//    return  response($response['access_token']);

 $accessToken = $response->json()['access_token'];

    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $accessToken = $provider->getAccessToken();
    // Add unique PayPal-Request-Id header

    $token=$accessToken['access_token'];
    // Create PayPal order with card payment source
       // Generate a unique PayPal-Request-Id
       $requestId = uniqid();

    //    return response()->json([$request->card_expiry]);
       // Send the request to PayPal
       $response = Http::withHeaders([
           'Content-Type' => 'application/json',
           'Authorization' => "Bearer $token",
           'PayPal-Request-Id' => $requestId,
       ])->post($endpointtest, [
           "intent" => "CAPTURE",
           "purchase_units" => [
               [
                   "amount" => [
                       "currency_code" => "USD",
                       "value" => number_format($request->total_price, 2, '.', ''),
                   ],
               ],
           ],

        "payment_source" => [
            "card" => [
                "number" => $request->card_number,
                "expiry" => $request->card_expiry,
                "security_code" => $request->card_cvv,
                "name" => $request->card_holder_name,
                "billing_address" => [
                    "address_line_1" => $request->billing_address['addressLine1'],
                    "address_line_2" => $request->billing_address['addressLine2'],
                    "admin_area_2" => $request->billing_address['city_name'],
                    "admin_area_1" => $request->billing_address['province_name'],
                    "postal_code" => $request->billing_address['postal_code'],
                    "country_code" => $request->billing_address['country_code']
                ],
            ]
        ]
    ]);
    // return response()->json([$request->card_expiry]);

    if (isset($response['status']) && $response['status'] === 'COMPLETED') {

        // return response()->json([$re->json()]);
        // Save the address
        $addressData = $request->input('address');

        $payment = PaypalPayment::create([
            'payment_id' => $response['id'],
            'amount' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
            'currency' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'], // Currency code
            'payer_name' => $response['payment_source']['card']['name'] , // Full payer name
            'payer_email' => $response['payer']['card']['email_address'] ?? 'Unknown',
            'payment_status' => $response['status'],
            'payment_method' => 'Card',
        ]);
        // return response()->json([$payment]);

        $address = Adress::create([
            'fullname' => $addressData['fullname'],
            'phone' => $addressData['phone'],
            'email' => $addressData['email'],
            'postal_code' => $addressData['postal_code'],
            'posta_number' => $addressData['posta_number'],
            'addressLine1' => $addressData['addressLine1'],
            'addressLine2' => $addressData['addressLine2'],
            'addressLine3' => $addressData['addressLine3'],
            'country_id' => $addressData['country_id'],
            'city_id' => $addressData['city_id'],
            'sub_city_id' => $addressData['sub_city_id'],
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $userId,
            'shppment_adress_id' => $address->id,
            'payment_id' =>$payment->id, // Use the PayPal transaction ID as the payment ID
            'status' => 'pending',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'orderId' => strtoupper(uniqid()),
        ]);
        // dd($order);
        foreach ($request['products'] as $product) {

            // return response()->json([$product]);
            if (!empty($product['options'])) {
            $attributes = $product['options'];
            }

            if (!empty($product['photopath'])) {
                foreach ($product['photopath'] as $photo) {
                    $path = $photo->store('photopath', 'public'); // Save photo to storage
                    // $photoPaths[] = Storage::url($path);// Add path to array
                    $photoPaths[] = $path;
                }
            }
            //    return response()->json([$photoPaths]);

            $product_id = (int)$product['product_id'];
            $quantity = (int)$product['quantity'];


            OrderDetail::create([
                  'order_id' => $order->id,
                  'product_id' =>$product_id,
                  'quantity' => $quantity,
                  'text_details' => $product['text_details'] ?? null,
                  'path' => $photoPaths ?? null,
                  'specifications' => $attributes?? null,
                  'delivery_date' => $request['delivery_date'], // Save delivery date
              ]);
               // Mark cart items as purchased
    Cart::where('user_id',  $userId)->update(['status' => 'purchased', 'order_id' => $order->id]);
            }
        // Create order details


        return response()->json([
            'success' => true,
            'message' => 'Payment successful, order created!',
            'order_id' => $order->id,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Payment failed.',
            'error' => $response->json(),
        ], 400);
    }
}









}




