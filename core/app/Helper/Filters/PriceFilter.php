<?php
namespace App\Helper\Filters;

class PriceFilter{
    function __invoke($query, $price){
        if($price['priceMin'] != null) $query = $query->where('price', '>=', $price['priceMin']);
        if($price['priceMax'] != null) $query = $query->where('price', '<=', $price['priceMax']);
        return $query;
        // return $query->where('price', '>=', $price['priceMin'])->where('price', '<=', $price['priceMax']);
    }
}