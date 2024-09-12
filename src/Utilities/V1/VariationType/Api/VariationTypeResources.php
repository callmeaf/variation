<?php

namespace Callmeaf\Variation\Utilities\V1\VariationType\Api;

use Callmeaf\Base\Utilities\V1\Resources;

class VariationTypeResources extends Resources
{
    public function index(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function store(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function show(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function update(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function statusUpdate(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function destroy(): self
    {
        $this->data = [
            'attributes' => [
                'id',
            ],
        ];
        return $this;
    }

}
