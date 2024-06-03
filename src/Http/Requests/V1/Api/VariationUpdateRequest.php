<?php

namespace Callmeaf\Variation\Http\Requests\V1\Api;

use Callmeaf\Base\Enums\DateTimeFormat;
use Callmeaf\Variation\Enums\VariationType;
use Callmeaf\Variation\Enums\VariationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class VariationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-variation.form_request_authorizers.variation'))->update();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $variationId = $this->route('variation')->variation_id;
        return validationManager(rules: [
            'status' => [new Enum(VariationStatus::class)],
            'type' => [new Enum(VariationType::class)],
            'title' => ['string','min:3','max:255'],
            'content' => ['string','max:700'],
            'sku' => ['string',Rule::unique(config('callmeaf-variation.model'),'sku')->ignore($variationId)],
            'stock' => ['integer'],
            'price' => ['numeric'],
            'discount_price' => ['numeric','lt:price'],
        ],filters: app(config("callmeaf-variation.validations.variation"))->update());
    }

}
