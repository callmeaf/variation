<?php

namespace Callmeaf\Variation\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class VariationIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-variation.form_request_authorizers.variation'))->index();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'title' => [],
            'sku' => [],
        ],filters: [
            ...app(config("callmeaf-variation.validations.variation"))->index(),
            ...config('callmeaf-base.default_searcher_validation'),
        ]);
    }

}
