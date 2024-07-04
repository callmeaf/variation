<?php

namespace Callmeaf\Variation\Http\Requests\V1\Api;

use Callmeaf\Variation\Enums\VariationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class VariationTypeStatusUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-variation-type.form_request_authorizers.variation_type'))->statusUpdate();
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
        ],filters: app(config("callmeaf-variation-type.validations.variation_type"))->statusUpdate());
    }

}
