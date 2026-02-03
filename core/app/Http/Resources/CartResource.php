<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'quantity'   => $this->quantity,
            'attributes' => $this->attributes,
            'product_id' => $this->product_id,
            'price'      => $this->price,
            'user_id'    => $this->user_id,
            'added_at'   => $this->created_at,
            'product'    => new ProductResource($this->product),
        ];
    }
}
