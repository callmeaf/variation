<?php

namespace Callmeaf\Variation\Utilities\V1\Api\Variation;

use Callmeaf\Base\Utilities\V1\Resources;

class VariationResources extends Resources
{
    public function index(): self
    {
        $this->data = [
            'relations' => [
                'product',
                'media',
                'type',
            ],
            'columns' => [
                'id',
                'variation_type_id',
                'status',
                'sku',
                'stock',
                'title',
                'price',
                'discount_price',
                'created_at',
                'updated_at',
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'sku',
                'stock',
                'title',
                'price',
                'price_text',
                'discount_price',
                'discount_price_text',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'id',
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
                'image',
                '!image' => [
                    'id',
                    'url',
                    'name',
                    'file_name',
                    'collection_name',
                    'mime_type',
                    'disk',
                    'size',
                ],
                'type',
                '!type' => [
                    'id',
                    'status',
                    'status_text',
                    'cat',
                    'cat_text',
                    'title',
                    'content',
                    'created_at_text',
                    'updated_at_text',
                ],
            ],
        ];
        return $this;
    }

    public function store(): self
    {
        $this->data = [
            'relations' => [
                'product'
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'sku',
                'stock',
                'title',
                'price',
                'price_text',
                'discount_price',
                'discount_price_text',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
                'image',
                '!image' => [
                    'id',
                    'url',
                    'name',
                    'file_name',
                    'collection_name',
                    'mime_type',
                    'disk',
                    'size',
                ],
            ],
        ];
        return $this;
    }

    public function show(): self
    {
        $this->data = [
            'relations' => [
                'product',
                'type',
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'sku',
                'stock',
                'title',
                'content',
                'price',
                'price_text',
                'discount_price',
                'discount_price_text',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
                'image',
                '!image' => [
                    'id',
                    'url',
                    'name',
                    'file_name',
                    'collection_name',
                    'mime_type',
                    'disk',
                    'size',
                ],
                'type',
                '!type' => [
                    'id',
                    'cat',
                    'title',
                ],
            ],
        ];
        return $this;
    }

    public function update(): self
    {
        $this->data = [
            'relations' => [
                'product',
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'sku',
                'stock',
                'title',
                'price',
                'price_text',
                'discount_price',
                'discount_price_text',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
                'image',
                '!image' => [
                    'id',
                    'url',
                    'name',
                    'file_name',
                    'collection_name',
                    'mime_type',
                    'disk',
                    'size',
                ],
            ],
        ];
        return $this;
    }

    public function statusUpdate(): self
    {
        $this->data = [
            'relations' => [
                'product',
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'sku',
                'stock',
                'title',
                'price',
                'price_text',
                'discount_price',
                'discount_price_text',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
            ],
        ];
        return $this;
    }

    public function destroy(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
            ],
        ];
        return $this;
    }

    public function imageUpdate(): Resources
    {
        $this->data = [
            'relations' => [
                'product',
            ],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'sku',
                'stock',
                'title',
                'price',
                'price_text',
                'discount_price',
                'discount_price_text',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
                'image',
                '!image' => [
                    'id',
                    'url',
                    'name',
                    'file_name',
                    'collection_name',
                    'mime_type',
                    'disk',
                    'size',
                ],
            ],
        ];
        return $this;
    }

}
