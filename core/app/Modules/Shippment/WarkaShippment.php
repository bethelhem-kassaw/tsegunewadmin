<?php

namespace App\Modules\Shippment;

use App\Models\ShippmentRate;

class WarkaShippment
{
    public function getRate($cityId, $product_size, $product_type)
    {
        $size = $this->floorSize($product_size);
        $rate = ShippmentRate::where('product_type', $product_type)
            ->where('city_id', $cityId)
            ->get();
        if ($rate) {
            $downed = 0;
            $myRate = $rate->where('size', $size)->first();
            while ($size > 0 && $myRate == null) {
                $size = $this->floorSize($size / 2);
                $myRate = $rate->where('size', $size)->first();
                $downed += 1;
                if ($downed > 4) {
                    return ['available' => false, 'message' => 'Price for this size is not seted'];
                }
            }
            $price = $myRate->price * pow(2, $downed);
            if (!$myRate) {
                return ['available' => false, 'message' => 'Price for this size is not seted'];
            }
            return ['available' => true, 'shippmentName' => 'Warka Delivery', 'price' => $price, 'currency' => 'USD', 'estimatedTime' => 'unknown', 'message' => 'success'];
        }
        return ['available' => false, 'message' => 'unsatisfied condition to calculate price'];
    }

    public function setWarkaDelivery($destinationAdress)
    {
        $productSize = cartWeight();
        return $this->getRate($destinationAdress->id, $productSize, 'non_document');
        // return ['available' => false, 'message' => 'Country not found'];
    }

    public function floorSize($size)
    {
        $floor = floor($size);
        if ($size - $floor == 0 || $size - $floor == 0.5) $floored = $size;
        elseif ($size - $floor > 0.5) $floored = ceil($size);
        else $floored = $floor + 0.5;
        return $floored;
    }
}
