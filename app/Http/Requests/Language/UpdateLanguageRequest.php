<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateLanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules()
    {
        return [
            'language' => 'required|string|in:' . implode(',', config('languages.available')),
        ];
    }

    public function messages()
    {
        return [
            'language.required' => __('validation.language.required'),
            'language.in' => __('validation.language.in'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => __('validation.validation_failed'),
            'errors' => $validator->errors(),
        ], 422));
    }
}
