<?php

namespace Callmeaf\Variation\Utilities\V1\VariationType\Api;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class VariationTypeFormRequestValidator extends FormRequestValidator
{
    public function index(): array
    {
        return [
            'status' => false,
            'title' => false,
            'cat' => false,
        ];
    }

    public function store(): array
    {
        return [
            'status' => true,
            'cat' => true,
            'title' => true,
            'content' => false,
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
            'cat' => true,
            'title' => true,
            'content' => false,
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

}
