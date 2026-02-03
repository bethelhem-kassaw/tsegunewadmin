<?php

namespace App\Http\Resources;

use App\Filament\Resources\CityResource;
use App\Http\Resources\Address\CityResource as AddressCityResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // 'shipment_price' => AddressCityResource::collection($this->shipment_rate),
            // 'shipment_price' =>new AddressCityResource($this->shipment_rate),
            'city' => $this->name,
        ];
    }
}
