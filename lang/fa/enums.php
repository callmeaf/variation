<?php

use Callmeaf\Variation\Enums\VariationNature;
use Callmeaf\Variation\Enums\VariationStatus;
use Callmeaf\Variation\Enums\VariationTypeCat;
use Callmeaf\Variation\Enums\VariationTypeStatus;

return [
    VariationStatus::class => [
        VariationStatus::PAYED->name => 'پرداخت شده',
        VariationStatus::CANCELED->name => 'لغو شده',
        VariationStatus::PENDING->name => 'در حال انتظار',
        VariationStatus::PRODUCT->name => 'متعلق به محصول',
    ],
    VariationNature::class => [
        VariationNature::DEBTOR->name => 'بدهکار',
        VariationNature::CREDITOR->name => 'بستانکار',
    ],
    VariationTypeCat::class => [
        VariationTypeCat::PHYSICAL->name => 'فیزیکی',
        VariationTypeCat::DIGITAL->name => 'دیجیتال',
    ],
    VariationTypeStatus::class => [
        VariationTypeStatus::ACTIVE->name => 'فعال',
        VariationTypeStatus::INACTIVE->name => 'غیرفعال',
    ],
];
