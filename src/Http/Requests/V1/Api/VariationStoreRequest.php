<?php

namespace Callmeaf\Variation\Http\Requests\V1\Api;

use Callmeaf\Base\Enums\DateTimeFormat;
use Callmeaf\Variation\Enums\VariationStatus;
use Callmeaf\Variation\Enums\VariationType;
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
            'product_id' => [Rule::exists(config('callmeaf-product.model'),'id')],
            'status' => [new Enum(VariationStatus::class)],
            'type' => [new Enum(VariationType::class)],
            'title' => ['string','min:3','max:255'],
            'content' => ['string','max:700'],
            'sku' => ['string',Rule::unique(config('callmeaf-variation.model'),'sku')],
            'stock' => ['integer'],
            'price' => ['numeric'],
            'discount_price' => ['numeric','lt:price'],
        ],filters: app(config("callmeaf-variation.validations.variation"))->store());
    }

}
