<?php

namespace App\Http\Requests\Display;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreDisplayRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'resolution_height' => ['required', 'integer', 'min:1'],
            'resolution_width' => ['required', 'integer', 'min:1'],
            'type' => ['required', 'in:indoor,outdoor'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.display.name_required'),
            'name.string' => __('validation.display.name_string'),
            'name.max' => __('validation.display.name_max'),
            'description.required' => __('validation.display.description_required'),
            'description.string' => __('validation.display.description_string'),
            'price_per_day.required' => __('validation.display.price_per_day_required'),
            'price_per_day.numeric' => __('validation.display.price_per_day_numeric'),
            'price_per_day.min' => __('validation.display.price_per_day_min'),
            'resolution_height.required' => __('validation.display.resolution_height_required'),
            'resolution_height.integer' => __('validation.display.resolution_height_integer'),
            'resolution_height.min' => __('validation.display.resolution_height_min'),
            'resolution_width.required' => __('validation.display.resolution_width_required'),
            'resolution_width.integer' => __('validation.display.resolution_width_integer'),
            'resolution_width.min' => __('validation.display.resolution_width_min'),
            'type.required' => __('validation.display.type_required'),
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
