<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class OrderController extends Controller
{

    public function myOrders(Request $request){
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


            // return 'You have an account';
            $guestUserId = session()->getId();
            $orders = Order::with('orderDetails', 'payment')->where('user_id', $userId)->get();
            return $orders;





    }




    

    /*

       $table->unsignedBigInteger('user_id', 0)->nullable();
            $table->unsignedBigInteger('shppment_adress_id', 0);
            $table->unsignedBigInteger('payment_id', 0);
            $table->string('status')->default('received');
            $table->string('trcking_id')->default('unset');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('set null');
            $table->foreign('shppment_adress_id')->references('id')->on('adresses');
            $table->string('name')->nullable();    // For guest name
            $table->string('email')->nullable();
            $table->string('phone')->nullable();   // For guest email
            $table->foreign('payment_id')->references('id')->on('transactions');

     */


      // Place Order (With or Without Account)
      public function placeOrder(Request $request)
      {
          $validatedData = $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email',
              'phone' => 'required|string',
              'address' => 'required|string',
              'total' => 'required|numeric|min:0.01',
          ]);

          // If user is logged in, attach the user_id
          $userId = Auth::check() ? Auth::id() : session()->getId();


          // Create the order
          $order = Order::create([
              'user_id' => $userId,
              'name' => $validatedData['name'],
              'email' => $validatedData['email'],
              'phone' => $validatedData['phone'],
              'address' => $validatedData['address'],
              'total' => $validatedData['total'],
              'status' => 'pending',
          ]);

          return response()->json([
              'message' => 'Order placed successfully',
              'order' => $order,
          ], 201);
      }
    // Optional: Create an Account After Order (Guest Checkout)
    public function createAccount(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json([
            'message' => 'Account created successfully',
            'user' => $user,
        ]);
    }
}
