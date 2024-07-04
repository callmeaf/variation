<?php

namespace Callmeaf\Variation\Http\Requests\V1\Api;

use Callmeaf\Variation\Enums\VariationTypeCat;
use Callmeaf\Variation\Enums\VariationTypeStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class VariationTypeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-variation-type.form_request_authorizers.variation_type'))->store();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'status' => [new Enum(VariationTypeStatus::class)],
            'cat' => [new Enum(VariationTypeCat::class)],
            'title' => ['string'],
            'content' => ['string'],
        ],filters: app(config("callmeaf-variation-type.validations.variation_type"))->store());
    }

}
