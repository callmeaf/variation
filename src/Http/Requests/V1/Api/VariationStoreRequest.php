<?php

namespace Callmeaf\Variation\Http\Requests\V1\Api;

use Callmeaf\Variation\Enums\VariationNature;
use Callmeaf\Variation\Enums\VariationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class VariationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-variation.form_request_authorizers.variation'))->store();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'status' => [new Enum(VariationStatus::class)],
            'variation_type_id' => [Rule::exists(config('callmeaf-variation-type.model'),'id')],
            'nature' => [new Enum(VariationNature::class)],
            'title' => ['string','min:3','max:255'],
            'content' => ['string','max:700'],
            'sku' => ['string',Rule::unique(config('callmeaf-variation.model'),'sku')],
            'stock' => ['integer'],
            'price' => ['numeric'],
            'discount_price' => ['numeric','lt:price'],
            'product_id' => [Rule::exists(config('callmeaf-product.model'),'id')],
        ],filters: app(config("callmeaf-variation.validations.variation"))->store());
    }

}
