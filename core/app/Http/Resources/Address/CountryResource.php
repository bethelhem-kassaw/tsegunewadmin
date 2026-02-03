<?php

namespace App\Http\Resources\Address;

use App\Http\Resources\ShipmentRateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'dial_code'         => $this->dial_code,
            'country_code'      => $this->country_code,
            'shippment_support' => $this->shippment_support,
            
            'cities'            => CityResource::collection($this->whenLoaded('cities')),
        ];
    }
}
