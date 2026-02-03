<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'fullname'     => $this->fullname,
            'phone'        => $this->phone,
            'email'        => $this->email,
            'country_id'   => $this->country_id,
            'city_id'      => $this->city_id,
            'posta_number' => $this->posta_number,
            'postal_code'  => $this->postal_code,
            'sub_city_id'  => $this->sub_city_id,
            'addressLine1' => $this->addressLine1,
            'addressLine2' => $this->addressLine2,
            'country'      => new CountryResource($this->country),
            'city'         => new CityResource($this->city),
            'subcity'      => new SubCityResource($this->subcity), 
        ];
    }
}
