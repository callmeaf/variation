<?php

namespace Callmeaf\Variation\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class VariationResource extends JsonResource
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return toArrayResource(data: [
            'id' => fn() => $this->id,
            'product_id' => fn() => $this->product_id,
            'status' => fn() => $this->status,
            'status_text' => fn() => $this->statusText,
            'sku' => fn() => $this->sku,
            'stock' => fn() => $this->stock,
            'title' => fn() => $this->title,
            'content' => fn() => $this->content,
            'price' => fn() => $this->price,
            'price_text' => fn() => $this->priceText,
            'discount_price' => fn() => $this->discount_price,
            'discount_price_text' => fn() =>  $this->discountPriceText,
            'created_at' => fn() => fn() =>  $this->created_at,
            'created_at_text' => fn() => $this->createdAtText,
            'updated_at' => fn() => $this->updated_at,
            'updated_at_text' => fn() => $this->updatedAtText,
            'product' => fn() => $this->product ? new (config('callmeaf-product.model_resource'))($this->product,only: $this->only['!product'] ?? []) : null,
            'image' => fn() => $this->product ? new (config('callmeaf-media.model_resource'))($this->image,only: $this->only['!image'] ?? []) : null,
            'type' => fn() => $this->type ? new (config('callmeaf-variation-type.model_resource'))($this->type,only: $this->only['!type'] ?? []) : null,
        ],only: $this->only);
    }
}
