<?php

use Callmeaf\Variation\Enums\VariationStatus;
use Callmeaf\Variation\Enums\VariationType;

return [
    VariationStatus::class => [
        VariationStatus::PAYED->name => 'Payed',
        VariationStatus::CANCELED->name => 'Cancelled',
        VariationStatus::PENDING->name => 'Pending',
        VariationStatus::PRODUCT->name => 'Belongs to product',
    ],
    VariationType::class => [
        VariationType::DEBTOR->name => 'Debtor',
        VariationType::CREDITOR->name => 'Creditor',
    ],
];
