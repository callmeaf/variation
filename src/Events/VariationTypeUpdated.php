<?php

namespace Callmeaf\Variation\Events;

use Callmeaf\Variation\Models\VariationType;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VariationTypeUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public VariationType $variationType)
    {

    }
}
