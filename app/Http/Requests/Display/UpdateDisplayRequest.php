<?php

namespace App\Http\Requests\Display;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateDisplayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'price_per_day' => ['sometimes', 'numeric', 'min:0'],
            'resolution_height' => ['sometimes', 'integer', 'min:1'],
            'resolution_width' => ['sometimes', 'integer', 'min:1'],
            'type' => ['sometimes', 'in:indoor,outdoor'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => __('validation.display.name_string'),
            'name.max' => __('validation.display.name_max'),
            'description.string' => __('validation.display.description_string'),
            'price_per_day.numeric' => __('validation.display.price_per_day_numeric'),
            'price_per_day.min' => __('validation.display.price_per_day_min'),
            'resolution_height.integer' => __('validation.display.resolution_height_integer'),
            'resolution_height.min' => __('validation.display.resolution_height_min'),
            'resolution_width.integer' => __('validation.display.resolution_width_integer'),
            'resolution_width.min' => __('validation.display.resolution_width_min'),
            'type.in' => __('validation.display.type_in'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => __('validation.failed'),
            'errors' => $validator->errors()
        ], 422));
    }
}
