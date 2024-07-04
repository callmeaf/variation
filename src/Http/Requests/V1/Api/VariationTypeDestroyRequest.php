<?php

namespace Callmeaf\Variation\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class VariationTypeDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-variation-type.form_request_authorizers.variation_type'))->destroy();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [

        ],filters: app(config("callmeaf-variation-type.validations.variation_type"))->destroy());
    }

}
