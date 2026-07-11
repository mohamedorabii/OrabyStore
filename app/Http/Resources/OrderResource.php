<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'order_number'   => $this->order_number,
            'status'         => $this->status,
            'total_price'    => $this->total_price,
            'shipping_price' => $this->shipping_price,
            'name'           => $this->name,
            'phone'          => $this->phone,
            'address'        => $this->address,
            'city'           => $this->city,
            'governorate'    => $this->governorate,
            'items'          => OrderItemResource::collection($this->items),
            'created_at'     => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}