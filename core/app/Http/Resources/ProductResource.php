<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'supporting_name'  => $this->supporting_name,
            'description'      => $this->description,
            'main_category_id' => $this->mainCategory,
            'sub_category_id'  => $this->sub_category_id,
            'product_type'    => $this->product_type,
            // 'main_category'    => new CategoryResource($this->mainCategory),
            // 'sub_category'     => new SubCategoryResource($this->subCategory),
            'discount'         => $this->discount,
            'price'            => $this->price,
            'size'             => $this->size,
            'instock'          => $this->instock,
            'has_Images'          => $this->has_Images,
            'is_package'          => $this->is_package,
            'has_text'          => $this->has_text,
            'ammount_in_stock' => $this->ammount_in_stock,
            'company_id'       => $this->company_id,
            'photos'           => urlPhotos($this->photos),
            'attributes'       => $this->attributes,
            'top_description'  => $this->top_description,
        ];
    }
}
