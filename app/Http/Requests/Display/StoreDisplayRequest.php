<?php

namespace App\Http\Requests\Display;

use Illuminate\Foundation\Http\FormRequest;

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
}
