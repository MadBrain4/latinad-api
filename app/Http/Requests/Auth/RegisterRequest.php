<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('auth.register.name_required'),
            'name.string' => __('auth.register.name_string'),
            'name.max' => __('auth.register.name_max'),

            'email.required' => __('auth.register.email_required'),
            'email.email' => __('auth.register.email_invalid'),
            'email.unique' => __('auth.register.email_unique'),

            'password.required' => __('auth.register.password_required'),
            'password.string' => __('auth.register.password_string'),
            'password.min' => __('auth.register.password_min'),
            'password.confirmed' => __('auth.register.password_confirmed'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => __('auth.register.validation_failed'),
            'errors' => $validator->errors(),
        ], 422));
    }
}
