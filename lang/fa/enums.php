<?php

use Callmeaf\Variation\Enums\VariationStatus;
use Callmeaf\Variation\Enums\VariationType;

return [
    VariationStatus::class => [
        VariationStatus::PAYED->name => 'پرداخت شده',
        VariationStatus::CANCELED->name => 'لغو شده',
        VariationStatus::PENDING->name => 'در حال انتظار',
        VariationStatus::PRODUCT->name => 'متعلق به محصول',
    ],
    VariationType::class => [
        VariationType::DEBTOR->name => 'بدهکار',
        VariationType::CREDITOR->name => 'بستانکار',
    ],
];
