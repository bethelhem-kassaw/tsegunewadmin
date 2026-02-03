<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpecialProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'product_id'  => $this->product_id,
            'count_down'  => $this->count_down,
            'image'       => urlPhotos($this->path),
            'title'       => $this->title,
            'offer'       => $this->offer,
            'description' => $this->description,
            'status'      => $this->status,
            // 'options'     => $this->options,
            'product'     => new ProductResource($this->product),
        ];
    }
}
