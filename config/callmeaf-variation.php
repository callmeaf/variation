<?php

return [
    'model' => \Callmeaf\Variation\Models\Variation::class,
    'model_resource' => \Callmeaf\Variation\Http\Resources\V1\Api\VariationResource::class,
    'model_resource_collection' => \Callmeaf\Variation\Http\Resources\V1\Api\VariationCollection::class,
    'service' => \Callmeaf\Variation\Services\V1\VariationService::class,
    'default_values' => [
        'status' => \Callmeaf\Variation\Enums\VariationStatus::PRODUCT,
        'nature' => \Callmeaf\Variation\Enums\VariationNature::DEBTOR,
    ],
    'events' => [
        \Callmeaf\Variation\Events\VariationIndexed::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationStored::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationShowed::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationUpdated::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationStatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationDestroyed::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationRestored::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationTrashed::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationImageUpdated::class => [
            // listeners
        ],
    ],
    'validations' => [
        'variation' => \Callmeaf\Variation\Utilities\V1\Variation\Api\VariationFormRequestValidator::class,
    ],
    'resources' => [
        'variation' => \Callmeaf\Variation\Utilities\V1\Variation\Api\VariationResources::class,
    ],
    'controllers' => [
        'variations' => \Callmeaf\Variation\Http\Controllers\V1\Api\VariationController::class,
    ],
    'form_request_authorizers' => [
        'variation' => \Callmeaf\Variation\Utilities\V1\Variation\Api\VariationFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'variation' => \Callmeaf\Variation\Utilities\V1\Variation\Api\VariationControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Variation\Utilities\V1\Variation\Api\VariationSearcher::class,
    'prefix_sku' => 'callmeaf-',
    'sku_length' => 6,
];
