<?php

return [
    'model' => \Callmeaf\Variation\Models\VariationType::class,
    'model_resource' => \Callmeaf\Variation\Http\Resources\V1\Api\VariationTypeResource::class,
    'model_resource_collection' => \Callmeaf\Variation\Http\Resources\V1\Api\VariationTypeCollection::class,
    'service' => \Callmeaf\Variation\Services\V1\VariationTypeService::class,
    'default_values' => [
        //
    ],
    'events' => [
        \Callmeaf\Variation\Events\VariationTypeIndexed::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationTypeStored::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationTypeShowed::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationTypeUpdated::class => [
            // listeners
        ],
        \Callmeaf\Variation\Events\VariationTypeDestroyed::class => [
            // listeners
        ],
    ],
    'validations' => [
        'variation_type' => \Callmeaf\Variation\Utilities\V1\VariationType\Api\VariationTypeFormRequestValidator::class,
    ],
    'resources' => [
        'index' => [
            'relations' => [
              //
            ],
            'columns' => [
                'id',
                'status',
                'cat',
                'title',
                'created_at',
                'updated_at',
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'cat',
                'cat_text',
                'title',
                'created_at_text',
                'updated_at_text',
            ],
        ],
        'store' => [
            'relations' => [

            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'cat',
                'cat_text',
                'title',
                'created_at_text',
                'updated_at_text',
            ],
        ],
        'show' => [
            'relations' => [
               //
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'cat',
                'cat_text',
                'title',
                'created_at_text',
                'updated_at_text',
            ],
        ],
        'update' => [
            'relations' => [
               //
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'cat',
                'cat_text',
                'title',
                'created_at_text',
                'updated_at_text',
            ],
        ],
        'status_update' => [
            'relations' => [
                //
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'cat',
                'cat_text',
                'title',
                'created_at_text',
                'updated_at_text',
            ],
        ],
        'destroy' => [
            'attributes' => [
                'id',
            ],
        ],
    ],
    'controllers' => [
        'variation_types' => \Callmeaf\Variation\Http\Controllers\V1\Api\VariationTypeController::class,
    ],
    'form_request_authorizers' => [
        'variation_type' => \Callmeaf\Variation\Utilities\V1\VariationType\Api\VariationTypeFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'variation_type' => \Callmeaf\Variation\Utilities\V1\VariationType\Api\VariationTypeControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Variation\Utilities\V1\VariationType\Api\VariationTypeSearcher::class,
];
