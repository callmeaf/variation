<?php

namespace Callmeaf\Variation\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class VariationImageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-variation.form_request_authorizers.variation'))->imageUpdate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'image' => ['image','max:1024'],
        ],filters: app(config("callmeaf-variation.validations.variation"))->imageUpdate());
    }

}
