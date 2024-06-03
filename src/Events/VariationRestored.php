<?php

namespace Callmeaf\Variation\Events;

use Callmeaf\Variation\Models\Variation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VariationRestored
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Variation $variation)
    {

    }
}
