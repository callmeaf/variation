<?php

namespace Callmeaf\Variation\Utilities\V1\Api\VariationType;

use Callmeaf\Base\Utilities\V1\Contracts\SearcherInterface;
use Illuminate\Database\Eloquent\Builder;

class VariationTypeSearcher implements SearcherInterface
{
    public function apply(Builder $query, array $filters = []): void
    {
        $filters = collect($filters)->filter(fn($item) => strlen(trim($item)));
        if($value = $filters->get('title')) {
            $query->where('title','like',searcherLikeValue($value));
        }
        if($value = $filters->get('cat')) {
            $query->where('cat','like',searcherLikeValue($value));
        }
    }
}
