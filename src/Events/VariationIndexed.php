<?php

namespace Callmeaf\Variation\Events;

use Callmeaf\Product\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;

class VariationIndexed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public LengthAwarePaginator|Collection|\Illuminate\Support\Collection|null $variations)
    {

    }
}
