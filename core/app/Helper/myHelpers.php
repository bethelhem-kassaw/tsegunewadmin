<?php

use App\Models\ToCartCount;

function objectToArray($object)
{
    if (!is_object($object) && !is_array($object)) {
        return $object;
    }
    return array_map('objectToArray', (array) $object);
}
function cartTotal()
{
    $carts = session()->get('cart');
    $total = 0.0;
    $total2 = 0.0;
    if ($carts) {
        foreach ($carts as $cart) {
            $total = $total + $cart['price'] * $cart['quantity'];
            $total2 = $total2 + ($cart['price'] - $cart['discount'] - $cart['promo_discount']) * $cart['quantity'];
        }
    }

    return ['total' => $total, 'discounted' => $total2];
}
function cartWeight()
{
    $carts = session()->get('cart');
    $weight = 0;
    if ($carts) {
        foreach ($carts as $cart) {
            $weight = $weight + $cart['size'] * $cart['quantity'];
        }
    }
    return $weight;
}
function makeFullAdress($city, $zip, $ad1 = null, $ad2 = null, $ad3 = null)
{
    $adress = $city;
    $adress .= $city . '(';
    $adress .= $zip . ') ';
    $adress .= $ad1;
    $adress .= $ad2 ? ',' : '';
    $adress .= $ad2;
    $adress .= $ad3 ? ',' : '';
    $adress .= $ad3;
    return $adress;
}

function countCartClick($prodct)
{
    $ip = request()->ip();
    $prev = ToCartCount::where('product_id', $prodct->id)
        ->where('ip_adress', $ip)
        ->whereDate('created_at', today())
        ->first();
    if ($prev) {
        $prev->count_per_day = $prev->count_per_day + 1;
        $prev->save();
    } else {
        ToCartCount::create([
            'product_id' => $prodct->id,
            'company_id' => $prodct->company_id,
            'ip_adress' => request()->ip(),
            'count_per_day' => 1,
        ]);
    }
}
function urlPhotos($photos)
{
    if ($photos == null) return null;
    $images = [];
    if (is_array($photos)) {
        foreach ($photos as $photo) array_push($images, asset('storage/' . $photo));
        return $images;
    }
    else return asset('storage/'.$photos);
}
