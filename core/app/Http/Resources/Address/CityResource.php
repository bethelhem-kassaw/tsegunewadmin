<?php

namespace App\Http\Resources\Address;

use App\Http\Resources\ShipmentRateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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

            // 'city_name' => $this->city->name,
            // 'id'         => $this->id,
            // 'name'       => $this->name,
            // 'zipcode'    => $this->zipcode,
            // 'status'     => $this->status,
            // 'shipment_rate' => new ShipmentRateResource($this->whenLoaded('shipmentRate')),  // Include shipment rate

            // 'subcityies' => SubCityResource::collection($this->whenLoaded('subcityies')),
        ];
    }
}
