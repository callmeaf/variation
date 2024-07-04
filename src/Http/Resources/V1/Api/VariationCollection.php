<?php

namespace Callmeaf\Variation\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VariationCollection extends ResourceCollection
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn($variation) => toArrayResource(data: [
                'id' => fn() => $variation->id,
                'product_id' => fn() => $variation->product_id,
                'status' => fn() => $variation->status,
                'status_text' => fn() => $variation->statusText,
                'sku' => fn() => $variation->sku,
                'stock' => fn() => $variation->stock,
                'title' => fn() => $variation->title,
                'content' => fn() => $variation->content,
                'price' => fn() => $variation->price,
                'price_text' => fn() => $variation->priceText,
                'discount_price' => fn() => $variation->discount_price,
                'discount_price_text' => fn() =>  $variation->discountPriceText,
                'created_at' => fn() => $variation->created_at,
                'created_at_text' => fn() => $variation->createdAtText,
                'updated_at' => fn() => $variation->updated_at,
                'updated_at_text' => fn() => $variation->updatedAtText,
                'product' => fn() => new (config('callmeaf-product.model_resource'))($variation->product,only: $this->only['!product'] ?? []),
                'image' => fn() => new (config('callmeaf-media.model_resource'))($variation->image,only: $this->only['!image'] ?? []),
                'type' => fn() => new (config('callmeaf-variation-type.model_resource'))($variation->type,only: $this->only['!type'] ?? []),
            ],only: $this->only)),
        ];
    }
}
