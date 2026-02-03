<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\WishlistResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class CartController extends Controller
{


    public function myCart(Request $request)
    {
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

        // if ($userId) {
        //     // Authenticated user: Retrieve cart items from the database
        //     $myCarts = Cart::where('user_id', $userId)->with('product')->get();
        //     return CartResource::collection($myCarts);
        // } else {
            // Get guest ID from cookie or create new one

        // $guestUserId = session()->getId();
        // return $guestUserId;
        // return response()->json( 'Guest user ID:'. $guestUserId , 200);
        $myCarts = Cart::where('user_id', $userId)->where('status', 'pending')->with('product')->get();
        return CartResource::collection($myCarts);

    }

    // public function myCart()
    // {
    //     // $userId = auth()->id();

    //     // $myCarts = Cart::where('user_id', auth()->id())->get();
    //     // return CartResource::collection($myCarts);
    //     $userId = auth()->id() ?? Session::getId();
    //     return $userId;
    //     $myCarts = Cart::where('user_id', $userId)->get();

    //     // if (auth()->check()) {
    //     //     $userId = auth()->id();

    //     //     // Fetch cart for authenticated user
    //     //     $myCarts = Cart::where('user_id', $userId)->get();
    //     // } else {
    //     //     // Guest users: fetch cart data from session
    //     //     $guestCart = Session::get('guest_cart', []);

    //     //     // Simulate cart collection for guests
    //     //     $myCarts = collect($guestCart);
    //     // }

    //     // Return the cart data
    //     return CartResource::collection($myCarts);


    // }
    // public function addToCart(AddToCartRequest $request)
    // {
    //     // return $request->specific_attributes;
    //     Cart::updateOrCreate(
    //         [
    //             'user_id'        => auth()->id(),
    //             'product_id'     => $request->product_id,
    //         ],
    //         [
    //             'quantity'       => $request->quantity ? $request->quantity : 1,
    //             'attributes' => $request->specific_attributes,
    //         ]
    //     );
    //     countCartClick(Product::find($request->product_id));
    //     $myCarts = Cart::where('user_id', auth()->id())->get();
    //     return CartResource::collection($myCarts);
    // }


//     public function addToCart(AddToCartRequest $request)
// {
//     // Check if user is authenticated
//     $userId = auth()->id();
//     // $userId = auth()->id() ?? Session::getId();
//     // If not authenticated, use a guest ID from cookie or create a new one
//     if (!$userId) {
//         // Non-authenticated user: Save to session
//         $cart = session()->get('cart', []);
//     //     $guestId = Cookie::get('guest_id');

//     //     // If no guest_id cookie exists, generate a new one
//     //     if (!$guestId) {
//     //         $guestId = (string) Str::uuid();
//     //         Cookie::queue('guest_id', $guestId, 60 * 24 * 7); // Expire in 7 days
//         }

//     //     $userId = $guestId; // Use guest ID as the user ID
//     // }

//     // Add or update cart record
//     Cart::updateOrCreate(
//         [
//             'user_id'    => $userId, // Authenticated user ID or guest ID
//             'product_id' => $request->product_id,
//         ],
//         [
//             'quantity'   => $request->quantity ? $request->quantity : 1,
//             'attributes' => $request->specific_attributes,
//         ]
//     );

//     // Count click on product (optional logic)
//     countCartClick(Product::find($request->product_id));

//     // Fetch updated cart
//     $myCarts = Cart::where('user_id', $userId)->get();
//     return CartResource::collection($myCarts);
// }
public function addToCart(AddToCartRequest $request)
{
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
//   return  response()->json([$userId]);

    // if ($userId) {
    //     // Authenticated user: Save to the database
    //     Cart::updateOrCreate(
    //         [
    //             'user_id' => $userId,
    //             'product_id' => $request->product_id,
    //         ],
    //         [
    //             'quantity' => $request->quantity ?: 1, // Default to 1 if no quantity provided
    //             'attributes' => $request->specific_attributes,
    //         ]
    //     );

    //     // Optional: Count cart click (if needed)
    //     countCartClick(Product::find($request->product_id));

    //     // Retrieve updated cart for authenticated user
    //     $myCarts = Cart::where('user_id', $userId)->get();
    //     return CartResource::collection($myCarts);
    // } else {
        // Non-authenticated user: Save to session

        // $allCookies = $request->cookies->all();
        // $guestUserId = session()->getId();

        // return response()->json($guestUserId, 200);


        // $guestUserId = Cookie::get('guest_user_id');


        // if (!$guestUserId) {
        //     $guestUserId = (string) Str::uuid();
        //     $cookie = Cookie('guest_user_id', $guestUserId, 60 * 24 * 30); // 30 days expiry
        // }


Cart::updateOrCreate(
            [
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'price' => $request->price
            ],
            [
                'quantity' => $request->quantity ?: 1, // Default to 1 if no quantity provided
                'attributes' => $request->specific_attributes,
            ]
        );
        countCartClick(Product::find($request->product_id));
        $myCarts = Cart::where('user_id', $userId)->get();
        return CartResource::collection($myCarts);




}



    public function removeCart($id, Request $request)
    {
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

        // return $userId;
        Cart::where('product_id',$id)->delete();
        $myCarts = Cart::where('user_id', $userId)->get();
        return CartResource::collection($myCarts);
    }
    public function clearCart(Request $request)
    {

        $token = $request->bearerToken();
        // $userId = auth()->id(); // Get authenticated user ID, if available
        $accessToken = PersonalAccessToken::findToken($token);

        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable) {
                $userId = $accessToken->tokenable->id;
            }
        }

        Cart::where('user_id',$userId)->delete();
        return ['status' => 'success', 'message' => 'cleared successfully'];
    }
    public function myFavorites(Request $request)
    {
        $token = $request->bearerToken();
        // $userId = auth()->id(); // Get authenticated user ID, if available
        $accessToken = PersonalAccessToken::findToken($token);
        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable) {
                $userId = $accessToken->tokenable->id;
            }
        }

        $wishLists = Wishlist::where('user_id', $userId)->get();
        return WishlistResource::collection($wishLists);
    }
    public function addToFavorite($productId,Request $request)
    {
        $token = $request->bearerToken();
        // $userId = auth()->id(); // Get authenticated user ID, if available
        $accessToken = PersonalAccessToken::findToken($token);
        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable) {
                $userId = $accessToken->tokenable->id;
            }
        }
        Wishlist::updateOrCreate([
            'user_id'    => $userId,
            'product_id' => $productId,
        ]);
        $wishLists = Wishlist::where('user_id',$userId)->get();
        return WishlistResource::collection($wishLists);
    }
    public function removeFavorite($favoriteId, Request $request)
    {
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
        }
        Wishlist::findOrFail($favoriteId)->delete();
        $wishLists = Wishlist::where('user_id', $userId)->get();
        return WishlistResource::collection($wishLists);
    }
    public function clearFavorite(Request $request)
    {
        $token = $request->bearerToken();
        // $userId = auth()->id(); // Get authenticated user ID, if available
        $accessToken = PersonalAccessToken::findToken($token);

        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable) {
                $userId = $accessToken->tokenable->id;
            }
        }
        Wishlist::where('user_id', $userId)->delete();
        return ['status' => 'success', 'message' => 'cleared successfully'];
    }
    public function favToCart($favoriteId,Request $request)
    {

        $token = $request->bearerToken();
        // $userId = auth()->id(); // Get authenticated user ID, if available
        $accessToken = PersonalAccessToken::findToken($token);

        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable) {
                $userId = $accessToken->tokenable->id;
            }
        }
        $wishlist = Wishlist::findOrFail($favoriteId);
        Cart::updateOrCreate(
            [
                'user_id'        => $userId,
                'product_id'     => $wishlist->product_id,
            ],
            [
                'quantity'       => 1,
                'attributes'     => null,
            ]
        );
        countCartClick(Product::find($wishlist->product_id));
        $wishlist->delete();
        return ['status' => 'success', 'message' => 'Wishlist transfered to cart successfully'];
    }
}
