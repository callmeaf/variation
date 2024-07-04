<?php

namespace Callmeaf\Variation\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VariationTypeCollection extends ResourceCollection
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
            'data' => $this->collection->map(fn($variationType) => toArrayResource(data: [
                'id' => fn() => $variationType->id,
                'status' => fn() => $variationType->status,
                'status_text' => fn() => $variationType->statusText,
                'cat' => fn() => $variationType->cat,
                'cat_text' => fn() => $variationType->catText,
                'title' => fn() => $variationType->title,
                'content' => fn() => $variationType->content,
                'created_at' => fn() => fn() =>  $variationType->created_at,
                'created_at_text' => fn() => $variationType->createdAtText,
                'updated_at' => fn() => $variationType->updated_at,
                'updated_at_text' => fn() => $variationType->updatedAtText,
            ],only: $this->only)),
        ];
    }
}
