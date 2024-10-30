<?php

namespace Callmeaf\Variation\Services\V1\Contracts;

use Callmeaf\Base\Services\V1\Contracts\BaseServiceInterface;

interface VariationServiceInterface extends BaseServiceInterface
{
    public function newSku(): ?string;
    public function decreaseStock(int $total = 1): self;
    public function increaseStock(int $total = 1): self;
}
