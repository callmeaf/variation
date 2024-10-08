<?php

namespace Callmeaf\Variation\Utilities\V1\Api\Variation;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class VariationFormRequestValidator extends FormRequestValidator
{
    public function index(): array
    {
        return [
            'title' => false,
            'sku' => false,
        ];
    }

    public function store(): array
    {
        return [
            'status' => true,
            'variation_type_id' => true,
            'sku' => false,
            'title' => false,
            'content' => false,
            'price' => false,
            'discount_price' => false,
            'stock' => false,
            'product_id' => false,
        ];
    }

    public function show(): array
    {
        return [];
    }

    public function update(): array
    {
        return [
            'status' => true,
            'variation_type_id' => true,
            'sku' => false,
            'title' => false,
            'content' => false,
            'price' => false,
            'discount_price' => false,
            'stock' => false,
        ];
    }

    public function statusUpdate(): array
    {
        return [
            'status' => true,
        ];
    }

    public function destroy(): array
    {
        return [];
    }


    public function imageUpdate(): array
    {
        return [
            'image' => true,
        ];
    }
}
