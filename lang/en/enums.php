<?php

use Callmeaf\Variation\Enums\VariationNature;
use Callmeaf\Variation\Enums\VariationStatus;
use Callmeaf\Variation\Enums\VariationTypeCat;
use Callmeaf\Variation\Enums\VariationTypeStatus;

return [
    VariationStatus::class => [
        VariationStatus::PAYED->name => 'Payed',
        VariationStatus::CANCELED->name => 'Cancelled',
        VariationStatus::PENDING->name => 'Pending',
        VariationStatus::PRODUCT->name => 'Belongs to product',
    ],
    VariationNature::class => [
        VariationNature::DEBTOR->name => 'Debtor',
        VariationNature::CREDITOR->name => 'Creditor',
    ],
    VariationTypeCat::class => [
        VariationTypeCat::PHYSICAL->name => 'Physical',
        VariationTypeCat::DIGITAL->name => 'Digital',
    ],
    VariationTypeStatus::class => [
        VariationTypeStatus::ACTIVE->name => 'Active',
        VariationTypeStatus::INACTIVE->name => 'InActive',
    ],

];
