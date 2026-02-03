<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\orderrequest;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderSuccessMail;
use App\Models\Adress;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\paypalpayment;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Str;

class Stripe_payment_controller extends Controller
{

    public function stripePayment(Request $request,orderrequest $orderrequest)
    {
        $stripe = new \Stripe\StripeClient(
          config('stripe.stripe_sk')
        );


        // Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys

    // Process Images
    $products = $orderrequest['products'];
    // return response()->json([ "heyyyy",$orderrequest->all()]);
    $processedProducts = [];
// return response()->json([$orderrequest->all()]);
foreach ($products  as $product) {
    $imagePaths = [];

    if (!empty($product['photopath'])) {

        foreach ($product['photopath'] as $photo) {

            // Save the image in the storage and get the path
            $imagePaths[] = $photo->store('photopath', 'public');
        }
    }

    // Add the image paths to the product


    $productModel = Product::find($product['product_id']);

    // if
    $product['name'] = $productModel->name;

    $product['photopath'] = $imagePaths;

    $processedProducts[] = $product;


    // dd($product);
}

 // Store address and other details in session or process them directly
 $checkoutData = [
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'product' =>$processedProducts,

    // $orderrequest->input('products'),
    'delivery_date' => $request->delivery_date,
    'delivery_time' => $request->delivery_time,

    'quantity' => $request->quantity,
    'price' => $request->price,
    'specifications'=>$request->input('specifications'),
    'address' => $request->input('address'),
    'total_price'=>$request->total_price,
    // 'photopath'=>$orderrequest->input('photopath'),
    'text_details'=>$request->text_details,
];


$transactionId = Str::uuid();
\Cache::put("checkout_data_{$transactionId}", $checkoutData, now()->addMinutes(60));

$lineItems = []; // Array to store line items

foreach ($processedProducts as $product) {



    $totalPrice = $product['price'];

//  return response()->json($product['options']);
    if (!empty($product['options'])) {
        foreach ($product['options'] as $attribute) {
        $price = $product['options']['values'];
        //  Attribute::where('id', $attribute)->products->values;  // Get price from attribute
        // return response()->json(["price"=>$price,"attribute"=>$attribute]);
            if (isset($price)) {
                $totalPrice += $price; // Add extra price from attribute
            }
        }
    }
$unitprice = $totalPrice * 100;

    $lineItems[] = [
        'price_data' => [
            'currency' => 'CAD',  // Specify the currency
            'product_data' => [
                'name' => $product['name'],  // Product name
            ],
            'unit_amount' => $product['price'] * 100,  // Price in cents
        ],
        'quantity' => $product['quantity'],  // Quantity for each product
    ];
}

// for every product check if ther is attribute and if ther is get the value and add to total price






// return response()->json([$lineItems]);


$response =$stripe->checkout->sessions->create([
  'line_items' => $lineItems,

  'mode' => 'payment',
  'success_url' => route('success'). "?transaction_id={$transactionId}&session_id={CHECKOUT_SESSION_ID}",
  'cancel_url' => route('cancel'),
]);





if(isset($response->id)&&$response->id !=''){

    session()->put('product_name', $request->product_name);
    session()->put('quantity', $request->quantity);
    session()->put('price', $request->price);
    session()->put('name', $request->name);
    session()->put('email', $request->email);
    session()->put('phone', $request->phone);
    session()->put('product', $processedProducts);
    session()->put('delivery_date' ,$request->delivery_date);
    session()->put('specifications', $request->input('specifications'));
    session()->put('address', $request->input('address'));
    session()->put('text_details', $request->text_details);
    session()->save();


return response()->json([
    'success' => true,
    'approval_url' => $response->url,
    'products' => $processedProducts,
   'session'=> session()->get('product'),
   'transaction'=> "transaction_id={$transactionId}",
]);
    return response()->json([
        'success' => true,
        'approval_url' => $response->url,
    ]);







}
else
{
    return response()->json(['error' => 'Payment was unsuccessful']);
}

// dd($response);

    }

    public function success(Request $request)
    {

// dd($request->all());
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
    // dd($userId);

    $transactionId = $request->query('transaction_id');

    $orderDetails = \Cache::get("checkout_data_{$transactionId}");



            $stripe = new \Stripe\StripeClient(
                config('stripe.stripe_sk')
              );

            $response = $stripe->checkout->sessions->retrieve($request->query('session_id'));
        // dd($response);


            if(isset($response['status']) && $response['status'] == 'complete') {
//   dd(session()->all());



// dd($orderDetails);

            $address = Adress::create([
                'fullname' => $orderDetails['name'],
                'phone' => $orderDetails['phone'],
                'email' => $orderDetails['email'],
                // 'postal_code' =>$orderDetails['address']['postal_code'],
                // 'posta_number' => $orderDetails['address']['posta_number'],
                'addressLine1' => $orderDetails['address']['addressLine1'],
                // 'addressLine2' => $orderDetails['address']['addressLine2'],
                // 'addressLine3' => $orderDetails['address']['addressLine3'],
                'country_id' => $orderDetails['address']['country_id'],
                'city_id' => $orderDetails['address']['city_id'],
                'buzz_number' => $orderDetails['address']['Buzz_code'],
                'unit_number' => $orderDetails['address']['unit_number'],

                // 'sub_city_id' => $orderDetails['address']['sub_city_id'],
            ]);

            // dd($response['total_price']);
  $total_amount = $response['amount_total'];



            $payment = paypalpayment::create([
                'payment_id' => $response['id'],
                'amount' => $total_amount/100,
                'currency' => $response['currency'],
                'payer_name' => $response['customer_details']['name'] ?? 'Unknown',
                'payer_email' => $response['customer_details']['email'] ?? 'Unknown',
                'payment_status' => $response['status'],
                'payment_method' => 'stripe',
            ]);


            $order = Order::create([

                'user_id' => $userId,
                'shppment_adress_id' => $address->id,
                'payment_id' => $payment->id,
                'status' => 'pending',
                'name' => $orderDetails['name'] ?? $response['customer_details']['name'] ?? null,
                'email' => $orderDetails['email']  ?? null,
                'phone' => $orderDetails['phone'] ?? null,
                'orderId' => strtoupper(uniqid()),
            ]);







            foreach ($orderDetails['product'] as $product) {


                if (!empty($product['options'])) {
                    $attributes = $product['options'];
                    }

                    $product_id = (int)$product['product_id'];
        $quantity = (int)$product['quantity'];


       $orderdetailx = OrderDetail::create([
              'order_id' => $order->id,
              'product_id' =>$product_id,
              'quantity' => $quantity,
              'text_details' => $product['text_details'] ?? null,
              'path' => $product['photopath'] ?? null,
              'specifications' => $attributes ?? null,
              'delivery_time' => $orderDetails['delivery_time'] ?? null,
                'delivery_date' => $orderDetails['delivery_date'], // Save delivery date
          ]);
        }

        if( $order){
            Mail::to($orderDetails['email'])->send(new OrderConfirmationMail($order));



        }



        if($orderdetailx){
            Mail::to('sinqmeal@gmail.com')->send(new OrderSuccessMail($order));
        }











           Cart::where('user_id',  $userId)->update(['status' => 'purchased', 'order_id' => $order->id]);
// dd($userId);
// $order = Order::where('orderId', $order->orderId)->first();
//          dd($order);

            return redirect()->away('https://sinqmeal.com/order-confirmation?order_id=' . $order->orderId);

    }
    }

    public function cancel()
    {
        return redirect()->away('https://sinqmeal.com/cart');
    }






}
