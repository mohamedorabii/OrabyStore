<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name_en,
            'description' => $this->desc_en,
            'price'       => $this->price,
            'image'       => asset('storage/' . $this->image),
            'category'    => $this->category?->name_en,
            'subcategory' => $this->subcategory?->name_en,
            'brand'       => $this->brand?->name,
        ];
    }
}